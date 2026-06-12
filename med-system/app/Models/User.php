<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; 

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{


    /** @use HasFactory<UserFactory> */
    use HasFactory,HasRoles, Notifiable;

     protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
             
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

  
      public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
       public function isDoctor(): bool
    {
        return $this->hasRole('doctor');
    }
    
    public function isPatient(): bool
    {
        return $this->hasRole('patient');
    }
    
  public function patient()
    {
        return $this->hasOne(Patient::class);
    }

  
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }
        return true;
    }

}
   
    

