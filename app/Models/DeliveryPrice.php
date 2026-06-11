<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryPrice extends Model
{
    protected $fillable = [
        'area_id',
        'district_id',
        'governorate_id',
        'price',
        'pricing_level',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

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
}