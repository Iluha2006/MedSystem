<?php

namespace App\DTOs;

class CreatePatientDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $birthDate,
        public readonly ?string $phone,
        public readonly ?string $medicalHistory,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            name: $validated['name'],
            email: $validated['email'],
            password: $validated['password'],
            birthDate: $validated['birth_date'] ?? null,
            phone: $validated['phone'] ?? null,
            medicalHistory: $validated['medical_history'] ?? null,
        );
    }

    public function toUserArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function toPatientArray(): array
    {
        return [
            'name' => $this->name,
            'birth_date' => $this->birthDate,
            'phone' => $this->phone,
            'medical_history' => $this->medicalHistory,
        ];
    }
}
