<?php

namespace App\Services;

use App\DTOs\CreatePatientDTO;
use App\DTOs\UpdatePatientDTO;
use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientService
{
    public function __construct(
        private readonly PatientRepository $patientRepository
    ) {}

    public function paginateForCurrentUser(?int $perPage = 15): LengthAwarePaginator
    {
        return $this->patientRepository->paginateForUser(auth()->user(), $perPage);
    }

    public function createPatient(CreatePatientDTO $dto): Patient
    {
        return $this->patientRepository->createWithUser($dto);
    }

    public function updatePatient(Patient $patient, UpdatePatientDTO $dto): bool
    {
        return $this->patientRepository->updatePatient($patient, $dto);
    }

    public function deletePatient(Patient $patient): ?bool
    {
        return $this->patientRepository->deleteWithUser($patient);
    }
}
