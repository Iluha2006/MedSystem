<?php

namespace App\DTOs;

class CreateVisitDTO
{
    public function __construct(
        public readonly int $patientId,
        public readonly int $doctorId,
        public readonly ?int $facilityId,
        public readonly string $complaint,
        public readonly string $visitDate,
    ) {}

    public static function fromRequest(array $validated, int $patientId, ?int $facilityId): self
    {
        return new self(
            patientId: $patientId,
            doctorId: (int) $validated['doctor_id'],
            facilityId: $facilityId,
            complaint: $validated['complaint'],
            visitDate: $validated['visit_date'],
        );
    }

    public function toArray(): array
    {
        return [
            'patient_id' => $this->patientId,
            'doctor_id' => $this->doctorId,
            'facility_id' => $this->facilityId,
            'complaint' => $this->complaint,
            'visit_date' => $this->visitDate,
        ];
    }
}
