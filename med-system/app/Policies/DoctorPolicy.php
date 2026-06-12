<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Doctor;

class DoctorPolicy
{
    
    public function viewAny(User $user): bool
    {
        return true; 
    }
  
    public function view(User $user, Doctor $doctor): bool
    {
       
        return true;
    }
    
   
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }
    
   
    public function update(User $user, Doctor $doctor): bool
    {
        
        if ($user->isAdmin()) return true;
        
      
        if ($user->isDoctor() && $user->id === $doctor->user_id) return true;
        
        return false;
    }
    
    
    public function delete(User $user, Doctor $doctor): bool
    {
        return $user->isAdmin();
    }
}