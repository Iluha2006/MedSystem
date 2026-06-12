<?php

namespace App\Repositories;

use App\DTOs\DoctorCardDTO;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DoctorRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Doctor;
    }

    /**
     * @return DoctorCardDTO[]
     */
    public function getDoctorsForMainPage(): array
    {
        return $this->model
            ->with('specialty')
            ->select('id', 'name', 'specialty_id')
            ->limit(4)
            ->get()
            ->map(fn($doctor) => new DoctorCardDTO(
                id: $doctor->id,
                name: $doctor->name,
                specialization: $doctor->specialty ? $doctor->specialty->name : 'Не указана',
            ))
            ->all();
    }

    public function findWithSpecialty(int $id): ?Doctor
    {
        /** @var Doctor|null */
        return $this->model->with('specialty')->find($id);
    }

    public function findWithFacilities(int $id): ?Doctor
    {
        /** @var Doctor|null */
        return $this->model->with('facilities')->find($id);
    }

    public function getAllWithSpecialtiesAndFacilities(): Collection
    {
        return $this->model->with(['specialty', 'facilities.buildings'])->get();
    }
}
