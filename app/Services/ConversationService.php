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
    $msg = $this->normalizeInput($message);

    $positives = [
        // English
        'yes', 'y', 'yep', 'yeah', 'yup', 'ok', 'okay', 'ok!', 'okay!',
        'confirm', 'confirmed', 'approve', 'approved', 'accept', 'accepted',
        'sure', 'sure!', 'go', 'go ahead', 'proceed', 'do it', 'send it',
        'correct', 'right', 'perfect', 'great', 'good', 'sounds good',
        'yes please', 'yes!', 'ok go', 'ok confirm', 'yes confirm',
        'let\'s go', 'lets go', 'continue', 'done', 'finish', 'submit',

        // Franco-Arabic
        'aywa', 'aywa!', 'aywe', 'eh', 'eeh', 'eeeh', 'e', 'ah',
        'na3am', 'na3m', 'tamam', 'tamamm', 'tamem',
        'mwefe2', 'mwafek', 'mwafiq', 'mazbout', 'sah', 'sa7',
        'yalla', 'yalla!', 'yalla go', 'tf', 'tff', 'tfff',
        'kaml', 'kamle', 'kammil', 'mni7', 'mnih',
        '3anjad', 'okay 3anjad', 'ok 3anjad',
        'bas kammil', 'yii ok', 'hay ok',

        // Arabic
        'نعم', 'أيوا', 'اي', 'إيه', 'آه', 'تمام', 'موافق',
        'اوكي', 'أكد', 'صح', 'صحيح', 'تمام تمام',
        'موافق نعم', 'نعم موافق', 'اوك', 'اوكي',
        'امضي', 'كمل', 'كملي', 'أكمل', 'ارسل',
        'اه نعم', 'اي نعم', 'طيب', 'طب',

        // French
        'oui', 'oui!', 'bien sur', 'bien sûr', 'd accord',
        'd\'accord', 'confirme', 'confirmé', 'ok oui',
    ];

    foreach ($positives as $word) {
        if ($msg === $word || str_starts_with($msg, $word . ' ') || str_ends_with($msg, ' ' . $word) || str_contains($msg, ' ' . $word . ' ')) {
            return true;
        }
        if ($msg === $word) {
            return true;
        }
    }

    // Partial match for short inputs
    foreach (['yes', 'ok', 'aywa', 'tamam', 'nعم', 'confirm', 'eh', 'na3am', 'mwefe2', 'موافق', 'نعم', 'تمام', 'اوك'] as $key) {
        if (str_contains($msg, $key)) {
            return true;
        }
    }

    return false;
}

public function isRejection(string $message): bool
{
    $msg = $this->normalizeInput($message);

    $negatives = [
        // English
        'no', 'n', 'nope', 'nah', 'cancel', 'cancelled', 'canceled',
        'reject', 'rejected', 'stop', 'abort', 'nevermind', 'never mind',
        'don\'t', 'dont', 'no thanks', 'no thank you', 'not now',
        'forget it', 'forget', 'quit', 'exit', 'back', 'go back',
        'change', 'edit', 'modify', 'wrong', 'incorrect', 'mistake',

        // Franco-Arabic
        'la', 'la2', 'la2!', 'laa', 'laaa', 'mesh', 'mish', 'mis',
        'ma bde', 'ma bdi', 'ma badde', 'ma bade',
        'msh mwafek', 'msh mwefe2', 'mish mwafek',
        'ghalat', '3andi ghalat', 'fi ghalat', 'badde ghayyer',
        'baddel', 'ghayyer', 'wlefish',

        // Arabic
        'لا', 'لأ', 'لا!', 'الغ', 'الغي', 'إلغاء', 'إلغاء الطلب',
        'ما بدي', 'مش موافق', 'مش صح', 'غلط', 'فيه غلط',
        'بدي غير', 'بدي بدل', 'مش هيك', 'مو هيك',
        'لا شكرا', 'لا شكراً', 'مش هلق', 'وقفني',

        // French
        'non', 'annuler', 'annulé', 'pas', 'pas maintenant',
    ];

    foreach ($negatives as $word) {
        if ($msg === $word || str_contains($msg, $word)) {
            return true;
        }
    }

    return false;
}

/**
 * Normalize input for comparison.
 */
private function normalizeInput(string $message): string
{
    $msg = strtolower(trim($message));

    // Normalize Arabic-Indic numbers to Western
    $arabicNums  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    $westernNums = ['0','1','2','3','4','5','6','7','8','9'];
    $msg = str_replace($arabicNums, $westernNums, $msg);

    // Remove extra spaces
    $msg = preg_replace('/\s+/', ' ', $msg);

    return $msg;
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