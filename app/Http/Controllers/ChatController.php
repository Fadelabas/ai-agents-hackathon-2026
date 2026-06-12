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
use Illuminate\Support\Facades\Log;

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
        'message' => 'required|string|max:1000',
        'token'   => 'required|string',
    ]);

    $token   = $request->input('token');
    $message = trim($request->input('message'));

    if (empty($message)) {
        return response()->json(['type' => 'message', 'message' => 'Shu badak?']);
    }

    $session = $this->conversation->getOrCreate($token);

    // Awaiting confirmation
    if ($this->conversation->isAwaitingConfirmation($session)) {
        return $this->handleConfirmation($session, $message, $token);
    }

    // Save phone immediately if present in message
    $extracted = $session->extracted_data ?? [];
    if (empty($extracted['customer_phone'])) {
        $phone = $this->extractPhoneFromMessage($message);
        if ($phone) {
            $this->conversation->updateExtracted($session, ['customer_phone' => $phone]);
        }
    }

    // Add to history
    $this->conversation->addMessage($session, 'user', $message);
    $session->refresh();

    // Call Gemini
    $response = $this->gemini->chat($session->history);

    if ($response['type'] === 'order_data') {
        $data      = $response['data'];
        $extracted = $session->extracted_data ?? [];

        // Merge — never overwrite existing with null
        $merged = [
            'task_type'         => $data['task_type']         ?: ($extracted['task_type']         ?? null),
            'order_description' => $data['order_description'] ?: ($extracted['order_description'] ?? null),
            'area_text'         => $data['area_text']         ?: ($extracted['area_text']         ?? null),
            'exact_address'     => $data['exact_address']     ?: ($extracted['exact_address']     ?? null),
            'customer_phone'    => $data['customer_phone']    ?: ($extracted['customer_phone']    ?? null),
            'special_notes'     => $data['special_notes']     ?: ($extracted['special_notes']     ?? null),
        ];

        // Save merged data
        $this->conversation->updateExtracted($session, $merged);

        // Check what's still missing
        $missingMsg = $this->getMissingFieldMessage($merged);
        if ($missingMsg) {
            $this->conversation->addMessage($session, 'model', $missingMsg);
            return response()->json(['type' => 'message', 'message' => $missingMsg]);
        }

        // All 5 fields present — proceed to order
        return $this->handleOrderData($session, $merged, $token);
    }

    // Normal question from Gemini
    $this->conversation->addMessage($session, 'model', $response['message']);

    return response()->json([
        'type'    => 'message',
        'message' => $response['message'],
    ]);
}

private function getMissingFieldMessage(array $data): ?string
{
    $area = $data['area_text'] ?? null;

    if (empty($data['order_description'])) {
        return 'Shu exactly badak njiblek? W mn wein?';
    }
    if (empty($data['area_text'])) {
        return 'La ayya mantiqa?';
    }
    if (empty($data['exact_address'])) {
        return "Wein bil {$area} bil zabt? Shi landmark aw bineye?";
    }
    if (empty($data['customer_phone'])) {
        return 'Shu ra2am telephonek?';
    }

    return null;
}

private function extractPhoneFromMessage(string $message): ?string
{
    $arabicNums  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    $westernNums = ['0','1','2','3','4','5','6','7','8','9'];
    $msg = str_replace($arabicNums, $westernNums, $message);

    if (preg_match('/\+961\s?(\d[\s\-]?\d{3}[\s\-]?\d{3,4})/', $msg, $m)) {
        return '0' . preg_replace('/[\s\-]/', '', $m[1]);
    }
    if (preg_match('/\b(03|70|71|76|78|79|81)[\s\-]?\d{3}[\s\-]?\d{3,4}\b/', $msg, $m)) {
        return preg_replace('/[\s\-]/', '', $m[0]);
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
    $required = ['task_type', 'order_description', 'area_text', 'exact_address', 'customer_phone'];

    foreach ($required as $field) {
        if (empty($aiData[$field])) {
            $msg = match ($field) {
                'order_description' => 'Shu exactly badak njiblek? W mn wein?',
                'area_text' => 'La ayya mantiqa?',
                'exact_address' => 'Wein bil ' . ($aiData['area_text'] ?? 'mantiqa') . ' bil zabt? Shi landmark aw bineye?',
                'customer_phone' => 'Shu ra2am telephonek?',
                default => 'Shu badak njiblek?',
            };

            $this->conversation->addMessage($session, 'model', $msg);
            return response()->json(['type' => 'message', 'message' => $msg]);
        }
    }

    $prepared = $this->order->prepareOrder($aiData);

    $this->conversation->updateExtracted($session, [
        'task_type' => $aiData['task_type'],
        'order_description' => $aiData['order_description'],
        'area_text' => $aiData['area_text'],
        'exact_address' => $aiData['exact_address'],
        'customer_phone' => $aiData['customer_phone'],
        'price' => $prepared['pricing']['price'] ?? 5.00,
        'price_source' => $prepared['pricing']['price_source'] ?? 'default',
        'geo' => $prepared['geo'] ?? null,
        'awaiting_confirmation' => true,
    ]);

    $confirmMsg = $this->order->buildConfirmationMessage($prepared, $aiData['order_description']);
    $this->conversation->addMessage($session, 'model', $confirmMsg);

    return response()->json([
        'type' => 'confirmation',
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

        // ── Customer confirmed ────────────────────────────────────
        if ($this->conversation->isConfirmation($message)) {

            $extracted = $session->extracted_data;

            // Validate all required fields exist before creating order
            if (
            empty($extracted['task_type']) ||
            empty($extracted['order_description']) ||
            empty($extracted['area_text']) ||
            empty($extracted['exact_address']) ||
            empty($extracted['customer_phone'])
        ) {
                $replyMsg = "Baad fi ma3loumat na2se. Shu exactly badak njiblek? W mn wein?";
                $this->conversation->addMessage($session, 'model', $replyMsg);
                $this->conversation->updateExtracted($session, ['awaiting_confirmation' => false]);
                return response()->json(['type' => 'message', 'message' => $replyMsg]);
            }

            try {
                // Create the order
                $order = $this->order->createOrder([
                    'ai_data' => [
                        'task_type'         => $extracted['task_type'],
                        'area_text'         => $extracted['area_text'],
                        'exact_address'     => $extracted['exact_address'],
                        'customer_phone'    => $extracted['customer_phone'],
                        'order_description' => $extracted['order_description'] ?? null,
                    ],
                    'geo'     => $extracted['geo'] ?? ['area_id' => null, 'area_name' => $extracted['area_text']],
                    'pricing' => [
                        'price'        => $extracted['price'] ?? 5.00,
                        'price_source' => $extracted['price_source'] ?? 'default',
                    ],
                    'token'   => $token,
                ]);

                // Link order to session
                $this->conversation->linkOrder($session, $order->id);

                // Reset confirmation state
                $this->conversation->updateExtracted($session, [
                    'awaiting_confirmation' => false,
                ]);

                // Assign driver
                $driverMsg = $this->assignDriver($order);

                $replyMsg = "🎉 Order confirmed! We are finding a driver for you.\n" . $driverMsg;
                $this->conversation->addMessage($session, 'model', $replyMsg);

                return response()->json([
                    'type'    => 'message',
                    'message' => $replyMsg,
                ]);
            } catch (\Exception $e) {
                Log::error('Order creation failed', ['message' => $e->getMessage()]);
                $replyMsg = "⚠️ Sorry, we couldn't create your order. Please try again.";
                $this->conversation->addMessage($session, 'model', $replyMsg);
                return response()->json(['type' => 'message', 'message' => $replyMsg]);
            }
        }

        // ── Customer rejected ─────────────────────────────────────
        if ($this->conversation->isRejection($message)) {
            $this->conversation->updateExtracted($session, [
                'awaiting_confirmation' => false,
            ]);
            $replyMsg = "Tamam, cancelled the order. What do you want instead?";
            $this->conversation->addMessage($session, 'model', $replyMsg);
            return response()->json(['type' => 'message', 'message' => $replyMsg]);
        }

        // ── Neither (unclear response) ────────────────────────────
        $replyMsg = "Please confirm with Yes or No (yalla aw la2).";
        $this->conversation->addMessage($session, 'model', $replyMsg);
        return response()->json(['type' => 'message', 'message' => $replyMsg]);
    }

    /**
     * Assign driver logic.
     */
    private function assignDriver(Order $order): string
    {
        try {
            $assignmentService = app(DriverAssignmentService::class);
            return $assignmentService->assign($order);
        } catch (\Exception $e) {
            Log::error('Driver assignment failed', ['message' => $e->getMessage()]);
            return "We are searching for a driver in your area.";
        }
    }
}