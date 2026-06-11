<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'password',
        'district_id',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function driverOffers(): HasMany
    {
        return $this->hasMany(DriverOffer::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'assigned_driver_id');
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }
}