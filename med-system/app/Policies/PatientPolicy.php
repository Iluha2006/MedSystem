<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Patient;

class PatientPolicy
{
   
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }
    
   
    public function view(User $user, Patient $patient): bool
    {
        
        if ($user->isAdmin()) return true;
        
     
        if ($user->isDoctor()) return true;
        
       
        if ($user->isPatient() && $user->id === $patient->user_id) return true;
        
        return false;
    }
    
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }
   
    public function update(User $user, Patient $patient): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }
    
   
    public function delete(User $user, Patient $patient): bool
    {
        return $user->isDoctor()|| $user->isAdmin()  ;
    }
}