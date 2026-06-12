<?php

namespace App\Repositories;

use App\DTOs\CreatePatientDTO;
use App\DTOs\UpdatePatientDTO;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Patient;
    }

    public function createWithUser(CreatePatientDTO $dto): Patient
    {
        $userData = $dto->toUserArray();
        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);
        $user->assignRole('patient');

        $patientData = $dto->toPatientArray();
        $patientData['user_id'] = $user->id;

        $patient = $this->create($patientData);

        return $patient;
    }

    public function updatePatient(Patient $patient, UpdatePatientDTO $dto): bool
    {
        $updated = $this->update($patient, $dto->toArray());

        if ($updated && $patient->user) {
            $patient->user->update(['name' => $dto->name]);
        }

        return $updated;
    }

    public function deleteWithUser(Patient $patient): ?bool
    {
        if ($patient->user) {
            return $patient->user->delete();
        }

        return $this->delete($patient);
    }

    public function paginateForUser(?User $user, int $perPage = 15): LengthAwarePaginator
    {
        if ($user && $user->can('viewAny', Patient::class)) {
            return $this->model->with('user')->paginate($perPage);
        }

        return $this->model->where('user_id', $user?->id)->with('user')->paginate($perPage);
    }

    public function findWithUser(int $id): ?Patient
    {
        /** @var Patient|null */
        return $this->model->with('user')->find($id);
    }
}
