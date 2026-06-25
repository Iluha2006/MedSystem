<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InpatientStay extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'admission_date',
        'discharge_date',
        'condition',
        'temperature',
    ];

    protected $casts = [
        'admission_date' => 'date',
        'discharge_date' => 'date',
        'temperature' => 'decimal:2',
    ];

    // Пациент еще лежит в больнице?
    public function getIsActiveAttribute(): bool
    {
        return $this->discharge_date === null;
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function attendingDoctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}