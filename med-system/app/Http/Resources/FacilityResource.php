<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
           'type' => $this->type === 'hospital' ? 'Больница' : 'Поликлиника',
            'address' => $this->address,
              'buildings' => BuildingResource::collection($this->whenLoaded('buildings')),
        ];
    }
}