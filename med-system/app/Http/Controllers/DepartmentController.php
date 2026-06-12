<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $departments = Department::with(['building.facility'])
            ->get()
            ->map(fn($dept) => [
                'id' => $dept->id,
                'name' => $dept->name,
                'specialization' => $dept->specialization,
                'building' => $dept->building?->name,
                'facility' => $dept->building?->facility?->name,
                'doctor_count' => $dept->building?->facility?->doctors()->count() ?? 0,
            ]);

        return Inertia::render('Departments/Index', [
            'auth' => $user ? [
                'user' => [
                    ...$user->toArray(),
                    'role' => $user->getRoleNames()->first(),
                ],
            ] : null,
            'departments' => $departments,
        ]);
    }

    public function show(Department $department)
    {
        $user = auth()->user();

        $department->load(['building.facility']);

        $facility = $department->building?->facility;

        $doctors = collect();
        if ($facility) {
            $doctors = Doctor::with(['specialty', 'degree', 'academicTitle'])
                ->whereHas('facilities', fn($q) => $q->where('facilities.id', $facility->id))
                ->get()
                ->map(fn($doc) => [
                    'id' => $doc->id,
                    'name' => $doc->name,
                    'specialty' => $doc->specialty?->name ?? 'Не указана',
                    'degree' => $doc->degree?->name,
                    'academic_title' => $doc->academicTitle?->name,
                    'experience_years' => $doc->experience_years,
                    'hazard_coeff' => $doc->hazard_coeff,
                ]);
        }

        return Inertia::render('Departments/Show', [
            'auth' => $user ? [
                'user' => [
                    ...$user->toArray(),
                    'role' => $user->getRoleNames()->first(),
                ],
            ] : null,
            'department' => [
                'id' => $department->id,
                'name' => $department->name,
                'specialization' => $department->specialization,
                'building' => $department->building?->name,
                'facility' => $facility?->name,
                'facility_address' => $facility?->address,
            ],
            'doctors' => $doctors,
        ]);
    }
}
