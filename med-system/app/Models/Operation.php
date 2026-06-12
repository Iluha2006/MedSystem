<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'facility_id',
        'operation_date',
        'name',
        'operation_type',
        'diagnosis',
        'description',
        'result',
        'is_fatal',
        'complications',
    ];

    protected $casts = [
        'operation_date' => 'datetime',
        'is_fatal' => 'boolean',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}