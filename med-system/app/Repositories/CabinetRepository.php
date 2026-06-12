<?php

namespace App\Repositories;

use App\Models\Cabinet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CabinetRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Cabinet;
    }

    public function getActiveCabinets(): array 
    {
        return $this->model
            ->active()
            ->with('facility:id,name')
            ->select('id', 'facility_id', 'cabinet_number', 'name')
            ->get()
            ->map(fn($cabinet) => [
                'id' => $cabinet->id,
                'full_name' => $cabinet->full_name,
                'facility_name' => $cabinet->facility?->name,
            ])
            ->toArray(); 
    }
}