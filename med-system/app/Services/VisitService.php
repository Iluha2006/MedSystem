<?php

namespace App\Services;

use App\DTOs\CreateVisitDTO;
use App\Models\OutpatientVisit;
use App\Repositories\DoctorRepository;
use App\Repositories\OutpatientVisitRepository;
use Illuminate\Database\Eloquent\Collection;

class VisitService
{
    public function __construct(
        private readonly OutpatientVisitRepository $visitRepository,
   
    ) {}

    public function getAllForCurrentUser(): Collection
    {
       
        $user = auth()->user();

        return $this->visitRepository->getAllForUser($user);
    }

    public function createVisit(CreateVisitDTO $dto): OutpatientVisit
    {
        return $this->visitRepository->createVisit($dto);
    }

    public function updateVisit(OutpatientVisit $visit, array $data): bool
    {
        return $this->visitRepository->update($visit, $data);
    }

    public function confirmVisit(OutpatientVisit $visit): bool
    {
        return $this->visitRepository->confirm($visit);
    }

    public function cancelVisit(OutpatientVisit $visit): bool
    {
        return $this->visitRepository->cancel($visit);
    }

    public function completeVisit(OutpatientVisit $visit, array $data = []): bool
    {
        return $this->visitRepository->complete($visit, $data);
    }
}
