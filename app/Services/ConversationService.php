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
                    'order_description'     => null,
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
    $msg = $this->normalize($message);

    // FIRST: check for negation words — these override confirmation
    $negations = [
        'ma ', ' ma ', 'mesh', 'mish', 'la2', ' la ', 'laa',
        'no ', ' no', 'cancel', 'not yet', 'ma talbt', 'ma bade',
        'ma badde', 'b3d', 'ba3d', 'بعد', 'ما ', ' ما', 'مش',
        'لا', 'لأ', 'مش موافق', 'ما بدي', 'ما طلبت', 'الغ',
    ];

    foreach ($negations as $neg) {
        if (str_contains($msg, trim($neg))) {
            return false;
        }
    }

    // THEN: check for confirmation words
    $positives = [
        'yes', 'yep', 'yeah', 'yup', 'ok', 'okay',
        'sure', 'confirm', 'confirmed', 'approve', 'approved',
        'accept', 'accepted', 'correct', 'right', 'perfect',
        'go', 'proceed', 'do it', 'send it', 'continue',
        'aywa', 'aywe', 'eh', 'eeh', 'ah', 'aah',
        'na3am', 'na3m', 'tamam', 'tmam', 'tamem',
        'mwefe2', 'mwafek', 'mazbout', 'sah',
        'yalla', 'tf', 'kaml', 'kamle', 'akid', 'akeed',
        'نعم', 'أيوا', 'تمام', 'موافق', 'أكيد', 'اوكي',
        'صح', 'طيب', 'اوك', 'كمل',
        'oui', 'bien sur', 'd accord',
    ];

    foreach ($positives as $word) {
        if ($msg === $word || str_contains($msg, $word)) {
            return true;
        }
    }

    return false;
}
private function normalize(string $message): string
{
    // Convert Arabic-Indic numerals to Western
    $arabicNums  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    $westernNums = ['0','1','2','3','4','5','6','7','8','9'];
    $msg = str_replace($arabicNums, $westernNums, $message);

    // Lowercase and trim
    $msg = strtolower(trim($msg));

    // Remove extra spaces
    $msg = preg_replace('/\s+/', ' ', $msg);

    return $msg;
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