<?php

namespace App\Repositories;

use App\DTOs\RegisterUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new User;
    }

    public function createUser(RegisterUserDTO $dto): User
    {
        $data = $dto->toArray();
        $data['password'] = Hash::make($data['password']);

        /** @var User $user */
        $user = $this->create($data);
        $user->assignRole('patient');

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        /** @var User|null */
        return $this->model->where('email', $email)->first();
    }

    public function findWithDoctor(int $id): ?User
    {
        /** @var User|null */
        return $this->model->with('doctor')->find($id);
    }
}
