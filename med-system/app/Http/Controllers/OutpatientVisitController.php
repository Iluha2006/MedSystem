<?php

namespace App\Http\Controllers;

use App\DTOs\CreateVisitDTO;
use App\Http\Requests\Visit\StoreVisitRequest;
use App\Http\Requests\Visit\UpdateVisitRequest;
use App\Http\Resources\DoctorResource;
use App\Models\OutpatientVisit;
use App\Services\VisitService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class OutpatientVisitController extends Controller
{
    public function __construct(
        private readonly VisitService $visitService
    ) {}

    public function index(): Response
    {
        
        $user = auth()->user();

        $visits = $this->visitService->getAllForCurrentUser();

        return Inertia::render('Visits/Index', [
            'visits' => $visits,
            'can' => [
                'create' => $user->can('create', OutpatientVisit::class),
                'update' => $user->can('update', OutpatientVisit::class),
                'delete' => $user->can('delete', OutpatientVisit::class),
                'confirm' => $user->can('confirm', OutpatientVisit::class),
            ],
            'auth' => [
                'user' => $user,
                'role' => $user->getRoleNames()->first(),
            ]
        ]);
    }

    public function create(): Response
    {
        $doctors = \App\Models\Doctor::with(['specialty', 'facilities.buildings'])->get();

        return Inertia::render('Visits/Create', [
            'doctors' => DoctorResource::collection($doctors)->resolve(),
        ]);
    }

    public function store(StoreVisitRequest $request): RedirectResponse
    {
   
        $user = auth()->user();

    
        $patient = $user->patient;
        $doctor = \App\Models\Doctor::with('facilities')->find($request->validated()['doctor_id']);
        $facilityId = $doctor?->facilities->first()?->id;

        $dto = CreateVisitDTO::fromRequest($request->validated(), $patient->id, $facilityId);
        $this->visitService->createVisit($dto);

        return redirect()->route('visits.index')
            ->with('success', 'Запись успешно создана');
    }

     public function show(OutpatientVisit $visit): Response
    {
        $user = auth()->user();
        
     
        $visit->load([
            'patient', 
            'doctor.specialty', 
            'facility',  
            'doctor.facilities'  
        ]);
      

        return Inertia::render('Visits/Show', [
            'visit' => $visit,
            'auth' => [
                'user' => $user,
                'role' => $user->getRoleNames()->first(),
            ]
        ]);
    }

    public function edit(OutpatientVisit $visit): Response
    {
        
        $user = auth()->user();

        if ($user->cannot('update', $visit)) {
            abort(403);
        }

        return Inertia::render('Visits/Edit', [
            'visit' => $visit->load(['patient', 'doctor.specialty', 'facility']),
            'doctors' => \App\Models\Doctor::with('specialty', 'facilities')->get(),
        ]);
    }

    public function update(UpdateVisitRequest $request, OutpatientVisit $visit): RedirectResponse
    {
        $this->authorize('update', $visit);

        $this->visitService->updateVisit($visit, $request->validated());

        return redirect()->route('visits.index')
            ->with('success', 'Запись обновлена');
    }

    public function destroy(OutpatientVisit $visit): RedirectResponse
    {
        $this->authorize('delete', $visit);

        $this->visitService->cancelVisit($visit);

        return redirect()->route('visits.index')
            ->with('success', 'Запись отменена');
    }

    public function confirm(OutpatientVisit $visit): RedirectResponse
    {
        
    
        $this->visitService->confirmVisit($visit);

        return redirect()->route('visits.index')
            ->with('success', 'Запись подтверждена');
    }
}
