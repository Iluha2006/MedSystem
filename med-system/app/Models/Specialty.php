<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'can_perform_operations',
        'has_hazard_pay',
        'extended_vacation_days'
    ];

    protected $casts = [
        'can_perform_operations' => 'boolean',
        'has_hazard_pay' => 'boolean',
    ];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}