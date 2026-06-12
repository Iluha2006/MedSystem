<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutpatientVisit extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'facility_id',
        'assigned_cabinet_id',
        'visit_date',
        'complaint',
        'diagnosis',
        'prescription',
        'status',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function assignedCabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class, 'assigned_cabinet_id');
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

     public function getStatusLabelAttribute(): string
    {
        return [
            'scheduled' => 'Запланирован',
            'confirmed' => 'Подтверждён',
            'cancelled' => 'Отменён',
            'completed' => 'Завершён',
        ][$this->status] ?? $this->status;
    }
    
}