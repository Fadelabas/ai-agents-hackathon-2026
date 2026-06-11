<?php

namespace App\Services;

use App\Models\ConversationSession;

class ConversationService
{
    /**
     * Load or create session by token.
     */
    public function getOrCreate(string $token): ConversationSession
    {
        return ConversationSession::firstOrCreate(
            ['session_token' => $token],
            [
                'history'        => [],
                'extracted_data' => [
                    'task_type'      => null,
                    'area_text'      => null,
                    'exact_address'  => null,
                    'customer_phone' => null,
                    'price'          => null,
                    'price_source'   => null,
                    'awaiting_confirmation' => false,
                ],
            ]
        );
    }

    /**
     * Append a message to the conversation history.
     */
    public function addMessage(ConversationSession $session, string $role, string $content): void
    {
        $history   = $session->history ?? [];
        $history[] = ['role' => $role, 'content' => $content];
        $session->history = $history;
        $session->save();
    }

    /**
     * Update extracted data fields.
     */
    public function updateExtracted(ConversationSession $session, array $data): void
    {
        $existing = $session->extracted_data ?? [];
        $session->extracted_data = array_merge($existing, $data);
        $session->save();
    }

    /**
     * Check if we are waiting for price confirmation.
     */
    public function isAwaitingConfirmation(ConversationSession $session): bool
    {
        return $session->extracted_data['awaiting_confirmation'] ?? false;
    }

    /**
     * Check if customer confirmed (yes in any language).
     */
    public function isConfirmation(string $message): bool
    {
        $msg = strtolower(trim($message));

        $positives = [
            'yes', 'yep', 'yeah', 'yup', 'ok', 'okay',
            'aywa', 'ayy', 'na3am', 'nar', 'tf', 'tfff',
            'oui', 'bien sur', 'bien sûr', 'd accord',
            'confirm', 'confirmed', 'go', 'sure', 'ok go',
            'mnih', 'mni7', 'kaml', 'kamle', 'proceed',
            'نعم', 'أيوا', 'اه', 'تمام', 'موافق', 'اوك',
        ];

        foreach ($positives as $word) {
            if (str_contains($msg, $word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if customer rejected.
     */
    public function isRejection(string $message): bool
    {
        $msg = strtolower(trim($message));

        $negatives = [
            'no', 'nope', 'la', 'la2', 'non', 'cancel',
            'stop', 'nevermind', 'never mind', 'mish',
            'لا', 'الغ', 'بطل', 'ما بدي',
        ];

        foreach ($negatives as $word) {
            if (str_contains($msg, $word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Clear session data after order is created.
     */
    public function linkOrder(ConversationSession $session, int $orderId): void
    {
        $session->order_id = $orderId;
        $session->save();
    }
}