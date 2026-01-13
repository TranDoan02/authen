<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FlashSale extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(FlashSaleProduct::class);
    }

    public function isActive(): bool
    {
        $now = now();
        return $this->is_active 
            && $this->start_time <= $now 
            && $this->end_time >= $now;
    }
}
