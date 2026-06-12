<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalStaff extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'position',
        'facility_id',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}