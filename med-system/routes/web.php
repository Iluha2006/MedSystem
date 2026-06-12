<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Repositories\DoctorRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OutpatientVisitController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;



Route::get('/', function (DoctorRepository $doctorRepository) {
    $user = auth()->user();

    return Inertia('Welcome', [
        'auth' => [
            'user' => $user ? [
                ...$user->toArray(),
                'role' => $user->getRoleNames()->first(),
            ] : null,
        ],
        'doctors' => array_map(fn($dto) => $dto->toArray(), $doctorRepository->getDoctorsForMainPage()),
    ]);
})->name('welcome');



Route::middleware(['auth'])->prefix('patients')->name('patients.')->group(function () {
    Route::get('/', [PatientController::class, 'index'])->name('index');
    Route::get('/create', [PatientController::class, 'create'])->name('create');
    Route::post('/save', [PatientController::class, 'store'])->name('store');
    Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit');
    Route::put('/update/{patient}', [PatientController::class, 'update'])->name('update');
    Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/appointments', [DoctorController::class, 'index'])->name('appointments');
    Route::put('/appointments/{visit}', [DoctorController::class, 'update'])->name('appointments.update');
    Route::post('/appointments/{visit}/complete', [DoctorController::class, 'complete'])->name('appointments.complete');
    Route::post('/appointments/{visit}/cancel', [DoctorController::class, 'cancel'])->name('appointments.cancel');
});


Route::middleware(['auth'])->prefix('visits')->name('visits.')->group(function () {
    Route::get('/', [OutpatientVisitController::class, 'index'])->name('index'); 
    Route::get('/create', [OutpatientVisitController::class, 'create'])->name('create');
    Route::post('/create', [OutpatientVisitController::class, 'store'])->name('store');
    Route::get('/{visit}', [OutpatientVisitController::class, 'show'])->name('show');
    Route::get('/{visit}/edit', [OutpatientVisitController::class, 'edit'])->name('edit');
    Route::put('/update/{visit}', [OutpatientVisitController::class, 'update'])->name('update');
    Route::delete('/delete/{visit}', [OutpatientVisitController::class, 'destroy'])->name('destroy');
    Route::post('/{visit}/confirm', [OutpatientVisitController::class, 'confirm'])->name('confirm');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');

require __DIR__.'/auth.php';
