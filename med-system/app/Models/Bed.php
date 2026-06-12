<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bed extends Model
{
    protected $fillable = ['ward_id', 'bed_number', 'is_occupied'];

    protected $casts = [
        'is_occupied' => 'boolean',
    ];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    
    public function inpatientStays(): HasMany
    {
        return $this->hasMany(InpatientStay::class);
    }
}