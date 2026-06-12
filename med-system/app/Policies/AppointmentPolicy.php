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
        return true; // Все могут видеть свои записи (фильтрация в контроллере)
    }
    
    /**
     * Просмотр конкретной записи
     */
    public function view(User $user, OutpatientVisit $appointment): bool
    {
        // Админ может всё
        if ($user->isAdmin()) return true;
        
        // Врач может видеть записи к себе
        if ($user->isDoctor() && $user->doctor->id === $appointment->doctor_id) return true;
        
        // Пациент может видеть свои записи
        if ($user->isPatient() && $user->patient && $user->patient->id === $appointment->patient_id) return true;
        
        return false;
    }
    
    /**
     * Создание записи
     * - Пациент может создавать запись к врачу
     * - Врач может создавать запись для пациента
     * - Админ может создавать записи
     */
    public function create(User $user): bool
    {
        return $user->isPatient() || $user->isDoctor() || $user->isAdmin();
    }
    
    /**
     * Редактирование записи
     * - Админ может редактировать все
     * - Врач может редактировать записи к себе
     * - Пациент может отменить свою запись (но не редактировать)
     */
    public function update(User $user, ?OutpatientVisit $visit = null): bool
    {
        // Если есть конкретная запись - проверяем права на нее
        if ($visit) {
            if ($user->isAdmin()) return true;
            if ($user->isDoctor() && $user->doctor && $user->doctor->id === $visit->doctor_id) return true;
            return false;
        }
        
        // Общая проверка для действия update
        return $user->isAdmin() || $user->isDoctor();
    }
    
    /**
     * Отмена записи
     * - Пациент может отменить свою запись
     * - Врач может отменить запись к себе
     * - Админ может отменить любую запись
     */
    public function delete(User $user, OutpatientVisit $appointment = null): bool
    {
        // Если нет конкретной записи (общая проверка)
        if (!$appointment) {
            return $user->isAdmin() || $user->isDoctor() || $user->isPatient();
        }
        
        if ($user->isAdmin()) return true;
        if ($user->isDoctor() && $user->doctor && $user->doctor->id === $appointment->doctor_id) return true;
        if ($user->isPatient() && $user->patient && $user->patient->id === $appointment->patient_id) return true;
        
        return false;
    }

      public function confirm(User $user, OutpatientVisit $appointment = null): bool
    {
        if (!$appointment) {
            return $user->isAdmin() || $user->isDoctor();
        }
        
        if ($user->isAdmin()) return true;
        if ($user->isDoctor() && $user->doctor && $user->doctor->id === $appointment->doctor_id) return true;
        
        return false;
    }
}