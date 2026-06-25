<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name' => 'Кардиолог', 'can_perform_operations' => true, 'has_hazard_pay' => true, 'extended_vacation_days' => 35],
            ['name' => 'Невролог', 'can_perform_operations' => false, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Хирург', 'can_perform_operations' => true, 'has_hazard_pay' => true, 'extended_vacation_days' => 42],
            ['name' => 'Терапевт', 'can_perform_operations' => false, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Педиатр', 'can_perform_operations' => false, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Офтальмолог', 'can_perform_operations' => true, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Отоларинголог', 'can_perform_operations' => true, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Дерматолог', 'can_perform_operations' => false, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Эндокринолог', 'can_perform_operations' => false, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
            ['name' => 'Гинеколог', 'can_perform_operations' => true, 'has_hazard_pay' => false, 'extended_vacation_days' => 28],
        ];

        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate(['name' => $specialty['name']], $specialty);
        }

        $this->command->info('✅ Специальности: ' . Specialty::count());
    }
}