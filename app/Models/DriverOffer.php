<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverOffer extends Model
{
    protected $fillable = [
        'order_id',
        'driver_id',
        'status',
        'offered_at',
        'responded_at',
    ];

    protected $casts = [
        'offered_at'   => 'datetime',
        'responded_at' => 'datetime',
    ];

    // ── Status constants ──────────────────────────────────────
    const STATUS_PENDING  = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_EXPIRED  = 'expired';

    // ── Relationships ─────────────────────────────────────────
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    // ── Helper methods ────────────────────────────────────────
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    public function isExpired(): bool
    {
        return $this->status === self::STATUS_EXPIRED;
    }

    public function hasTimedOut(int $minutes = 10): bool
    {
        return $this->isPending()
            && $this->offered_at->diffInMinutes(now()) >= $minutes;
    }
}