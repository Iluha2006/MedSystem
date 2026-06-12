<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicTitle extends Model
{
    protected $fillable = ['name', 'required_degree_id']; 

 
    public function requiredDegree(): BelongsTo
    {
        return $this->belongsTo(Degree::class, 'required_degree_id');
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}