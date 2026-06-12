<?php

namespace App\Services;

use App\Models\ConversationSession;

class ConversationService
{
    public function getOrCreate(string $token): ConversationSession
    {
        return ConversationSession::firstOrCreate(
            ['session_token' => $token],
            [
                'history' => [],
                'extracted_data' => [
                    'task_type' => null,
                    'order_description' => null,
                    'area_text' => null,
                    'exact_address' => null,
                    'customer_phone' => null,
                    'price' => null,
                    'price_source' => null,
                    'awaiting_confirmation' => false,
                ],
            ]
        );
    }

    public function addMessage(ConversationSession $session, string $role, string $content): void
    {
        $history = $session->history ?? [];
        $history[] = ['role' => $role, 'content' => $content];

        $session->history = $history;
        $session->save();
    }

  public function updateExtracted(ConversationSession $session, array $data): void
{
    $existing = $session->extracted_data ?? [];

    foreach ($data as $key => $value) {
        // Never overwrite existing value with null or empty string
        if ($value === null || $value === '') {
            continue;
        }
        $existing[$key] = $value;
    }

    $session->extracted_data = $existing;
    $session->save();
}
    public function clearAwaitingConfirmation(ConversationSession $session): void
    {
        $data = $session->extracted_data ?? [];
        $data['awaiting_confirmation'] = false;

        $session->extracted_data = $data;
        $session->save();
    }

    public function isAwaitingConfirmation(ConversationSession $session): bool
    {
        return (bool)($session->extracted_data['awaiting_confirmation'] ?? false);
    }

    public function isConfirmation(string $message): bool
    {
        $msg = $this->normalize($message);

        $negations = [
            'ma', 'mesh', 'mish', 'la2', 'laa', 'no', 'cancel',
            'not yet', 'ma talabt', 'ma talbt', 'ma bade', 'ma bde',
            'ma badde', 'b3d', 'ba3d', 'بعد', 'ما', 'مش',
            'لا', 'لأ', 'مش موافق', 'ما بدي', 'ما طلبت', 'الغ', 'الغي',
        ];

        foreach ($negations as $neg) {
            if (str_contains($msg, $neg)) {
                return false;
            }
        }

        $positives = [
            'yes', 'ok', 'okay', 'confirm', 'confirmed',
            'sure', 'approve', 'approved', 'accept', 'accepted',
            'aywa', 'aywe', 'na3am', 'tamam', 'tmam', 'tamem',
            'mwefe2', 'mwafek', 'akid', 'akeed',
            'نعم', 'تمام', 'موافق', 'أكيد', 'اوكي', 'أوكي',
            'oui', 'd accord',
        ];

        foreach ($positives as $word) {
            if ($msg === $word) {
                return true;
            }
        }

        return false;
    }

    public function isRejection(string $message): bool
    {
        $msg = $this->normalize($message);

        $negatives = [
            'no', 'nope', 'nah', 'cancel', 'reject', 'stop',
            'nevermind', 'never mind', 'dont', "don't",
            'not now', 'forget it', 'wrong', 'mistake',
            'la', 'la2', 'laa', 'mesh', 'mish',
            'ma bde', 'ma bdi', 'ma badde', 'ma bade',
            'ghalat', 'badde ghayyer', 'ghayyer',
            'لا', 'لأ', 'الغ', 'الغي', 'إلغاء',
            'ما بدي', 'مش موافق', 'مش صح', 'غلط',
            'بدي غير', 'مش هيك', 'لا شكرا',
            'non', 'annuler',
        ];

        foreach ($negatives as $word) {
            if ($msg === $word || str_contains($msg, $word)) {
                return true;
            }
        }

        return false;
    }

    private function normalize(string $message): string
    {
        $arabicNums = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $westernNums = ['0','1','2','3','4','5','6','7','8','9'];

        $msg = str_replace($arabicNums, $westernNums, $message);
        $msg = strtolower(trim($msg));
        $msg = preg_replace('/\s+/', ' ', $msg);

        return $msg;
    }

    public function linkOrder(ConversationSession $session, int $orderId): void
    {
        $session->order_id = $orderId;
        $session->save();
    }
}