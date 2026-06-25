<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use App\Models\OutpatientVisit;

class AppointmentPolicy
{
    /**
     * Просмотр списка записей
     * - Админ: все записи
     * - Врач: свои записи
     * - Пациент: свои записи
     */
    public function viewAny(User $user): bool
    {
        return true;
    }
    
    public function view(User $user, OutpatientVisit $appointment): bool
    {
        return true;
    }
    
    public function create(User $user): bool
    {
        return true;
    }
    
    public function update(User $user, ?OutpatientVisit $visit = null): bool
    {
        return true;
    }
    
    public function delete(User $user, OutpatientVisit $appointment = null): bool
    {
        return true;
    }

      public function confirm(User $user, OutpatientVisit $appointment = null): bool
    {
        return true;
    }
}