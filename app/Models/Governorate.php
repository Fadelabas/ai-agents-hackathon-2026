<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Governorate extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
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