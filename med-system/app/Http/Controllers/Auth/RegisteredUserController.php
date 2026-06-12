<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RegisterUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisteredUserRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(StoreRegisteredUserRequest $request): RedirectResponse
    {
        $this->authService->register(RegisterUserDTO::fromRequest($request->validated()));

        return redirect(route('visits.index', absolute: false));
    }
}
