<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationSession extends Model
{
    protected $fillable = [
        'session_token',
        'history',
        'extracted_data',
        'order_id',
    ];

    protected $casts = [
        'history'        => 'array',
        'extracted_data' => 'array',
    ];

    // ── Relationships ─────────────────────────────────────────
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // ── Helper methods ────────────────────────────────────────
    public function hasAllFields(): bool
    {
        $data = $this->extracted_data;

        return !empty($data['task_type'])
            && !empty($data['area_text'])
            && !empty($data['exact_address'])
            && !empty($data['customer_phone']);
    }

    public function appendMessage(string $role, string $content): void
    {
        $history   = $this->history ?? [];
        $history[] = ['role' => $role, 'content' => $content];
        $this->history = $history;
        $this->save();
    }

    public function updateExtractedField(string $field, mixed $value): void
    {
        $data         = $this->extracted_data ?? [];
        $data[$field] = $value;
        $this->extracted_data = $data;
        $this->save();
    }
}