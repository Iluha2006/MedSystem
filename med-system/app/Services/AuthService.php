<?php

namespace App\Services;

use App\DTOs\RegisterUserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function register(RegisterUserDTO $dto): User
    {
        $user = $this->userRepository->createUser($dto);

        event(new Registered($user));

        Auth::login($user);

        return $user;
    }
}
