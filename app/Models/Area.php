<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = [
        'district_id',
        'name_ar',
        'name_en',
        'type',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(AreaAlias::class);
    }

    public function deliveryPrices(): HasMany
    {
        return $this->hasMany(DeliveryPrice::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}