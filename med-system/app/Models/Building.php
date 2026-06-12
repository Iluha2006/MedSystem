<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    protected $fillable = ['facility_id', 'name'];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}