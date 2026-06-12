<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorFacility extends Pivot
{
    protected $table = 'doctor_facilities';
    
    protected $fillable = ['doctor_id', 'facility_id', 'is_main_job', 'role'];

    protected $casts = [
        'is_main_job' => 'boolean',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}