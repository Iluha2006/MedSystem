<?php

namespace App\Repositories;

use App\DTOs\CreateVisitDTO;
use App\Models\OutpatientVisit;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OutpatientVisitRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new OutpatientVisit;
    }

    public function createVisit(CreateVisitDTO $dto): OutpatientVisit
    {
        $data = $dto->toArray();
        $data['status'] = 'pending';

      
        return $this->create($data);
    }

    public function findAllWithRelations(): Collection
    {
        return $this->model
            ->with(['patient', 'doctor.specialty', 'facility'])
            ->orderBy('visit_date', 'desc')
            ->get();
    }

    public function findByDoctor(int $doctorId): Collection
    {
        return $this->model
            ->where('doctor_id', $doctorId)
            ->with(['patient', 'doctor.specialty', 'facility'])
            ->orderBy('visit_date', 'desc')
            ->get();
    }

    public function findByPatient(int $patientId): Collection
    {
        return $this->model
            ->where('patient_id', $patientId)
            ->with(['patient', 'doctor.specialty', 'facility'])
            ->orderBy('visit_date', 'desc')
            ->get();
    }

    public function findWithRelations(int $id): ?OutpatientVisit
    {
     
        return $this->model
            ->with(['patient', 'doctor.specialty', 'facility'])
            ->find($id);
    }

    public function updateStatus(OutpatientVisit $visit, string $status): bool
    {
        return $this->update($visit, ['status' => $status]);
    }

    public function confirm(OutpatientVisit $visit): bool
    {
        return $this->updateStatus($visit, 'confirmed');
    }

    public function cancel(OutpatientVisit $visit): bool
    {
        return $this->updateStatus($visit, 'cancelled');
    }

    public function complete(OutpatientVisit $visit, array $data = []): bool
    {
        return $this->update($visit, array_merge(['status' => 'completed'], $data));
    }

    public function findDoctorAppointments(int $doctorId): Collection
    {
        return $this->model
            ->with(['patient', 'facility', 'assignedCabinet'])
            ->where('doctor_id', $doctorId)
            ->orderBy('visit_date', 'asc')
            ->get();
    }

    public function getAllForUser(User $user)
    {
        if ($user->isAdmin()) {
            return $this->findAllWithRelations();
        }

        if ($user->isDoctor() && $user->doctor) {
            return $this->findByDoctor($user->doctor->id);
        }

        if ($user->isPatient() && $user->patient) {
            return $this->findByPatient($user->patient->id);
        }

        return new Collection;
    }
}
