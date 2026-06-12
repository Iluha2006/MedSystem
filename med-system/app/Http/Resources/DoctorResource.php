<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'specialty' => $this->specialty?->name ?? 'Не указана',
            'experience_years' => $this->experience_years,
            'degree' => $this->degree?->name,
            'academic_title' => $this->academicTitle?->name,
            'hazard_coeff' => $this->hazard_coeff,
            'facilities' => FacilityResource::collection($this->whenLoaded('facilities')),
            'facility_names' => $this->whenLoaded('facilities', fn() => $this->facilities->pluck('name')->implode(', ')),
        ];
    }
}