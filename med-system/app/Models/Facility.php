<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facility extends Model
{
    protected $fillable = ['name', 'type', 'parent_hospital_id', 'address'];

    protected $casts = [
        'type' => 'string', 
    ];

  
    public function parentHospital(): BelongsTo
    {
        return $this->belongsTo(Facility::class, 'parent_hospital_id');
    }

   
    public function childFacilities(): HasMany
    {
        return $this->hasMany(Facility::class, 'parent_hospital_id');
    }

  
    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }

  
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_facilities');
    }

  
    public function laboratoryContracts(): HasMany
    {
        return $this->hasMany(LaboratoryContract::class);
    }
}