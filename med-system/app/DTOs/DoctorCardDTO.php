<?php

namespace App\DTOs;

class DoctorCardDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $specialization,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'specialization' => $this->specialization,
        ];
    }
}
