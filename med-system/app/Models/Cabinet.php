<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabinet extends Model
{
    protected $fillable = [
        'facility_id',
        'building_id',
        'cabinet_number',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

  
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    
    public function visits(): HasMany
    {
        return $this->hasMany(OutpatientVisit::class, 'assigned_cabinet_id');
    }

    
    public function getFullNameAttribute(): string
    {
        return "{$this->cabinet_number}" . ($this->name ? " - {$this->name}" : '');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}