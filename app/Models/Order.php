<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'session_token',
        'customer_phone',
        'original_message',
        'normalized_request',
        'order_description',
        'task_type',
        'area_text',
        'area_id',
        'area_name',
        'district_id',
        'district_name',
        'governorate_id',
        'governorate_name',
        'resolution_method',
        'exact_address',
        'price',
        'price_source',
        'assigned_driver_id',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // ── Status constants ──────────────────────────────────────
    const STATUS_PENDING         = 'pending';
    const STATUS_DRIVER_ASSIGNED = 'driver_assigned';
    const STATUS_IN_PROGRESS     = 'in_progress';
    const STATUS_COMPLETED       = 'completed';
    const STATUS_CANCELLED       = 'cancelled';

    // ── Task type constants ───────────────────────────────────
    const TYPE_MEDICINE  = 'medicine_delivery';
    const TYPE_FOOD      = 'food_delivery';
    const TYPE_GROCERY   = 'grocery_delivery';
    const TYPE_DOCUMENT  = 'document_delivery';
    const TYPE_SHOP      = 'shop_delivery';
    const TYPE_TAXI      = 'taxi_request';
    const TYPE_OTHER     = 'other';

    // ── Relationships ─────────────────────────────────────────
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function assignedDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id');
    }

    public function driverOffers(): HasMany
    {
        return $this->hasMany(DriverOffer::class);
    }

    public function conversationSession(): HasOne
    {
        return $this->hasOne(ConversationSession::class);
    }

    // ── Helper methods ────────────────────────────────────────
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isAssigned(): bool
    {
        return $this->status === self::STATUS_DRIVER_ASSIGNED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}