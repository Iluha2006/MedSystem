<?php

namespace App\DTOs;

class UpdatePatientDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $birthDate,
        public readonly ?string $phone,
        public readonly ?string $medicalHistory,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            name: $validated['name'],
            birthDate: $validated['birth_date'] ?? null,
            phone: $validated['phone'] ?? null,
            medicalHistory: $validated['medical_history'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'birth_date' => $this->birthDate,
            'phone' => $this->phone,
            'medical_history' => $this->medicalHistory,
        ];
    }
}
