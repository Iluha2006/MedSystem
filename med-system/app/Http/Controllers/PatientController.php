<?php

namespace App\Http\Controllers;

use App\DTOs\CreatePatientDTO;
use App\DTOs\UpdatePatientDTO;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function __construct(
        private readonly PatientService $patientService
    ) {}

    public function index()
    {
        $user = auth()->user();

        $patients = $this->patientService->paginateForCurrentUser();

        return Inertia::render('Patients/Index', [
            'patients' => $patients,
            'can' => [
                'create' => $user->can('create', Patient::class),
                'edit' => $user->can('update', Patient::class),
                'delete' => $user->can('delete', Patient::class),
            ],
            'auth' => [
                'user' => $user,
                'role' => $user->getRoleNames()->first(),
            ]
        ]);
    }

    public function create()
    {
        $this->authorize('create', Patient::class);

        return Inertia::render('Patients/Create');
    }

    public function store(StorePatientRequest $request)
    {
        $this->authorize('create', Patient::class);

        $this->patientService->createPatient(CreatePatientDTO::fromRequest($request->validated()));

        return redirect()->route('patients.index')
            ->with('success', 'Пациент успешно создан');
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);

        return Inertia::render('Patients/Edit', [
            'patient' => $patient->load('user'),
        ]);
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $this->patientService->updatePatient($patient, UpdatePatientDTO::fromRequest($request->validated()));

        return redirect()->route('patients.index')
            ->with('success', 'Данные пациента обновлены');
    }

    public function destroy(Patient $patient)
    {
        

        $this->patientService->deletePatient($patient);

        return redirect()->route('patients.index')
            ->with('success', 'Пациент удален');
    }
}
