<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['building_id', 'name', 'specialization'];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class);
    }
}