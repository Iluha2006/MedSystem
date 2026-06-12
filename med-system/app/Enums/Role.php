<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case DOCTOR = 'doctor';
    case PATIENT = 'patient';
    
    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Администратор',
            self::DOCTOR => 'Врач',
            self::PATIENT => 'Пациент',
        };
    }
}