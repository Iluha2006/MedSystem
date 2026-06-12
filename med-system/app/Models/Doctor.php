<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Doctor extends Model
{
    protected $fillable = [
          'user_id',
         'name',
        'specialty_id',
        'degree_id',
        'academic_title_id',
        'experience_years',
        'hazard_coeff',
     
    ];

    protected $casts = [
        'hazard_coeff' => 'decimal:2',
    ];
public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
   
    
   
    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    public function academicTitle(): BelongsTo
    {
        return $this->belongsTo(AcademicTitle::class, 'academic_title_id');
    }


    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'doctor_facilities')
           ;
    }

   
    public function inpatientStays(): HasMany
    {
        return $this->hasMany(InpatientStay::class, 'attending_doctor_id');
    }

    
    public function outpatientVisits(): HasMany
    {
        return $this->hasMany(OutpatientVisit::class);
    }

  
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}