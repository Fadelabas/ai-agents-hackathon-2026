<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AreaAlias extends Model
{
    protected $fillable = [
        'area_id',
        'alias',
        'language_type',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}