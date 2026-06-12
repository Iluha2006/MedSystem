<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_name' => $this->patient?->name,
            'complaint' => $this->complaint,
           'visit_date' => $this->visit_date?->format('Y-m-d\TH:i'), 
            'visit_date_formatted' => $this->visit_date?->format('d.m.Y H:i'), 
            'status' => $this->status,
            'status_label' => $this->getStatusLabelAttribute(),
            'facility_name' => $this->facility?->name,
            'cabinet' => $this->assignedCabinet?->cabinet_number,
            'diagnosis' => $this->diagnosis,
            'prescription' => $this->prescription,
        ];
    }
}