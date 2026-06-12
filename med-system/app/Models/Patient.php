<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'birth_date',
        'phone',
        'medical_history',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inpatientStays(): HasMany
    {
        return $this->hasMany(InpatientStay::class);
    }

    public function outpatientVisits(): HasMany
    {
        return $this->hasMany(OutpatientVisit::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
}