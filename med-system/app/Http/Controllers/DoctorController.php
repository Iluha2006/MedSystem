<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\OutpatientVisit;
use App\Repositories\CabinetRepository;
use App\Repositories\OutpatientVisitRepository;
use App\Services\VisitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DoctorController extends Controller
{
    public function __construct(
        private readonly OutpatientVisitRepository $visitRepository,
        private readonly CabinetRepository $cabinetRepository,
        private readonly VisitService $visitService
    ) {}

    public function index()
    {
        $doctor = auth()->user();


        

        $appointments = $this->visitRepository->findDoctorAppointments($doctor->doctor->id);
        $cabinets = $this->cabinetRepository->getActiveCabinets();

        return Inertia::render('Doctor/Appointments', [
            'appointments' => AppointmentResource::collection($appointments)->resolve(),
            'cabinets' => $cabinets,
        ]);
    }

    public function update(Request $request, OutpatientVisit $visit): RedirectResponse
    {
        $this->authorizeDoctor($visit);

        $validated = $request->validate([
            'status' => 'sometimes|in:scheduled,confirmed,cancelled,completed',
            'assigned_cabinet_id' => 'nullable|exists:cabinets,id',
            'complaint' => 'nullable|string|max:2000',
            'diagnosis' => 'nullable|string|max:1000',
            'prescription' => 'nullable|string|max:5000',
        ]);

        $visit->update($validated);

        return redirect()->back()->with('success', 'Запись обновлена');
    }

    public function complete(Request $request, OutpatientVisit $visit): RedirectResponse
    {
        $this->authorizeDoctor($visit);

        $validated = $request->validate([
            'diagnosis' => 'required|string|max:1000',
            'prescription' => 'nullable|string|max:5000',
        ]);

        $this->visitService->completeVisit($visit, [
            'diagnosis' => $validated['diagnosis'],
            'prescription' => $validated['prescription'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Приём завершён');
    }

    public function cancel(OutpatientVisit $visit): RedirectResponse
    {
        $this->authorizeDoctor($visit);

        $this->visitService->cancelVisit($visit);

        return redirect()->back()->with('success', 'Запись отменена');
    }

    private function authorizeDoctor(OutpatientVisit $visit): void
    {
        $doctor = auth()->user();

        if (!$doctor || !$doctor->doctor || $visit->doctor_id !== $doctor->doctor->id) {
            abort(403, 'У вас нет доступа к этой записи');
        }
    }
}
