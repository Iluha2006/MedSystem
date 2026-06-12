<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\OutpatientVisit;
use App\Policies\PatientPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\AppointmentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Patient::class => PatientPolicy::class,
        Doctor::class => DoctorPolicy::class,
        OutpatientVisit::class => AppointmentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}