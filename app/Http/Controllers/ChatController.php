<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ConversationService;
use App\Services\DriverAssignmentService;
use App\Services\GeminiService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function __construct(
        private GeminiService          $gemini,
        private ConversationService    $conversation,
        private OrderService           $order,
    ) {}

    /**
     * Show the customer chat page.
     */
    public function index()
    {
        return view('customer.chat');
    }

    /**
     * Handle incoming customer message.
     */
    public function message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'token'   => 'required|string',
        ]);

        $token   = $request->input('token');
        $message = trim($request->input('message'));

        // Load or create conversation session
        $session = $this->conversation->getOrCreate($token);

        // ── State: Waiting for price confirmation ─────────────
        if ($this->conversation->isAwaitingConfirmation($session)) {
            return $this->handleConfirmation($session, $message, $token);
        }

        // ── State: Normal conversation with Gemini ────────────
        $this->conversation->addMessage($session, 'user', $message);

        $response = $this->gemini->chat($session->history);

        // ── Gemini returned completed order data ──────────────
        if ($response['type'] === 'order_data') {
            return $this->handleOrderData($session, $response['data'], $token);
        }

        // ── Gemini returned a follow-up question ──────────────
        $this->conversation->addMessage($session, 'model', $response['message']);

        return response()->json([
            'type'    => 'message',
            'message' => $response['message'],
        ]);
    }

    /**
     * Gemini collected all 4 fields.
     * Resolve area, calculate price, show confirmation to customer.
     */
    private function handleOrderData(
        $session,
        array $aiData,
        string $token
    ) {
        // Prepare order (resolve geo + calculate price)
        $prepared = $this->order->prepareOrder($aiData);

        // Store prepared data in session
        $this->conversation->updateExtracted($session, [
            'task_type'             => $aiData['task_type'],
            'area_text'             => $aiData['area_text'],
            'exact_address'         => $aiData['exact_address'],
            'customer_phone'        => $aiData['customer_phone'],
            'price'                 => $prepared['pricing']['price'],
            'price_source'          => $prepared['pricing']['price_source'],
            'geo'                   => $prepared['geo'],
            'awaiting_confirmation' => true,
        ]);

        // Build and show price confirmation message
        $confirmMsg = $this->order->buildConfirmationMessage($prepared);

        $this->conversation->addMessage($session, 'model', $confirmMsg);

        return response()->json([
            'type'    => 'confirmation',
            'message' => $confirmMsg,
        ]);
    }

    /**
     * Customer responded to price confirmation.
     */
   private function handleConfirmation(
    $session,
    string $message,
    string $token
) {
    $this->conversation->addMessage($session, 'user', $message);

    // ── Customer confirmed ────────────────────────────────
    if ($this->conversation->isConfirmation($message)) {

        $extracted = $session->extracted_data;

        // Create the order
        $order = $this->order->createOrder([
            'ai_data' => [
                'task_type'      => $extracted['task_type'],
                'area_text'      => $extracted['area_text'],
                'exact_address'  => $extracted['exact_address'],
                'customer_phone' => $extracted['customer_phone'],
            ],
            'geo'     => $extracted['geo'],
            'pricing' => [
                'price'        => $extracted['price'],
                'price_source' => $extracted['price_source'],
            ],
            'token'   => $token,
        ]);

        // Link order to session
        $this->conversation->linkOrder($session, $order->id);

        // Reset awaiting confirmation
        $this->conversation->updateExtracted($session, [
            'awaiting_confirmation' => false,
        ]);

        // Assign driver
        $driverMsg = $this->assignDriver($order);

        $replyMsg = "🎉 Order confirmed! We are finding a driver for you.\n" . $driverMsg;
        $this->conversation->addMessage($session, 'model', $replyMsg);

        return response()->json([
            'type'     => 'order_created',
            'message'  => $replyMsg,
            'order_id' => $order->id,
            'token'    => $token,
        ]);
    }

    // ── Customer rejected ─────────────────────────────────
    if ($this->conversation->isRejection($message)) {

        $this->conversation->updateExtracted($session, [
            'awaiting_confirmation' => false,
            'task_type'             => null,
            'area_text'             => null,
            'exact_address'         => null,
            'customer_phone'        => null,
            'price'                 => null,
            'geo'                   => null,
        ]);

        // Clear history to start fresh
        $session->history = [];
        $session->save();

        $replyMsg = "No problem! Let's start over. What do you need?";
        $this->conversation->addMessage($session, 'model', $replyMsg);

        return response()->json([
            'type'    => 'cancelled',
            'message' => $replyMsg,
        ]);
    }

    // ── Unclear response ──────────────────────────────────
    $replyMsg = "Please reply with *yes* to confirm or *no* to cancel.";
    $this->conversation->addMessage($session, 'model', $replyMsg);

    return response()->json([
        'type'    => 'confirmation',
        'message' => $replyMsg,
    ]);
}
    /**
     * Attempt driver assignment and return status message.
     */
    private function assignDriver($order): string
    {
        try {
            $assignmentService = app(DriverAssignmentService::class);
            $offer = $assignmentService->assign($order);

            if ($offer) {
                return "A driver has been notified. Please wait...";
            }

            return "We are looking for an available driver in your area.";

        } catch (\Exception $e) {
            return "Driver assignment in progress...";
        }
    }
}