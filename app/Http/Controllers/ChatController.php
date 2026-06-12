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

    // Load or create session
    $session = $this->conversation->getOrCreate($token);

    // ── State: Waiting for price confirmation ─────────────────
    if ($this->conversation->isAwaitingConfirmation($session)) {
        return $this->handleConfirmation($session, $message, $token);
    }

    // ── Add message to history ────────────────────────────────
    $this->conversation->addMessage($session, 'user', $message);

    // ── Inject known session data into history context ────────
    // This prevents AI from asking again for already-known fields
    $extracted = $session->extracted_data ?? [];
    $history   = $session->history ?? [];

    // Build enriched history with known fields reminder
    $enrichedHistory = $history;
    $knownFields = [];
    if (!empty($extracted['task_type']))      $knownFields[] = "task_type: {$extracted['task_type']}";
    if (!empty($extracted['area_text']))      $knownFields[] = "area: {$extracted['area_text']}";
    if (!empty($extracted['exact_address']))  $knownFields[] = "address: {$extracted['exact_address']}";
    if (!empty($extracted['customer_phone'])) $knownFields[] = "phone: {$extracted['customer_phone']}";

    // Prepend system reminder about known fields
    if (!empty($knownFields)) {
        $reminder = "SYSTEM: Already collected from this session: " . implode(', ', $knownFields) . ". Do NOT ask for these again.";
        array_unshift($enrichedHistory, ['role' => 'user', 'content' => $reminder]);
        array_unshift($enrichedHistory, ['role' => 'model', 'content' => 'Understood, I will not ask for already provided information.']);
    }

    // ── Call Gemini ───────────────────────────────────────────
    $response = $this->gemini->chat($enrichedHistory);

    // ── Gemini returned completed order data ──────────────────
    if ($response['type'] === 'order_data') {

        // Merge with already-known session data
        $data = $response['data'];
        if (empty($data['customer_phone']) && !empty($extracted['customer_phone'])) {
            $data['customer_phone'] = $extracted['customer_phone'];
        }
        if (empty($data['area_text']) && !empty($extracted['area_text'])) {
            $data['area_text'] = $extracted['area_text'];
        }
        if (empty($data['exact_address']) && !empty($extracted['exact_address'])) {
            $data['exact_address'] = $extracted['exact_address'];
        }

        return $this->handleOrderData($session, $data, $token);
    }

    // ── Save extracted fields progressively ──────────────────
    // Try to extract phone from message even if Gemini didn't return JSON
    if (empty($extracted['customer_phone'])) {
        $phone = $this->extractPhoneFromMessage($message);
        if ($phone) {
            $this->conversation->updateExtracted($session, ['customer_phone' => $phone]);
        }
    }

    // ── Gemini returned a follow-up question ──────────────────
    $this->conversation->addMessage($session, 'model', $response['message']);

    return response()->json([
        'type'    => 'message',
        'message' => $response['message'],
    ]);
}

/**
 * Extract phone number from raw message text.
 */
private function extractPhoneFromMessage(string $message): ?string
{
    // Match Lebanese phone numbers
    if (preg_match('/\b(03|70|71|76|78|79|81)\d{6}\b/', $message, $matches)) {
        return $matches[0];
    }
    // With spaces: 03 123 456
    if (preg_match('/\b(03|70|71|76|78|79|81)\s?\d{3}\s?\d{3,4}\b/', $message, $matches)) {
        return preg_replace('/\s/', '', $matches[0]);
    }
    return null;
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
    $geo     = $this->order->prepareOrder($aiData)['geo'] ?? [];
    $pricing = $this->order->prepareOrder($aiData)['pricing'] ?? [];

    // Prepare full order data
    $prepared = $this->order->prepareOrder($aiData);

    // Store all extracted data in session
    $this->conversation->updateExtracted($session, [
        'task_type'             => $aiData['task_type'],
        'area_text'             => $aiData['area_text'],
        'exact_address'         => $aiData['exact_address'],
        'customer_phone'        => $aiData['customer_phone'],
        'order_description'     => $aiData['order_description'] ?? null,
        'price'                 => $prepared['pricing']['price'],
        'price_source'          => $prepared['pricing']['price_source'],
        'geo'                   => $prepared['geo'],
        'awaiting_confirmation' => true,
    ]);

    // Build confirmation message
    $confirmMsg = $this->order->buildConfirmationMessage($prepared, $aiData['order_description'] ?? null);
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