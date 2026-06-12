<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    protected $fillable = [
        'name',
        'profile',
    ];

    
    public function contracts(): HasMany
    {
        return $this->hasMany(LaboratoryContract::class);
    }
}