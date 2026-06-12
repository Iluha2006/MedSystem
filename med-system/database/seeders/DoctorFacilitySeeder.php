<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Facility;

class DoctorFacilitySeeder extends Seeder
{
    public function run(): void
    {
        $doctors = Doctor::all();
        $facilities = Facility::all();
        
        if ($doctors->isEmpty()) {
            $this->command->error('Нет врачей! Сначала создайте врачей.');
            return;
        }
        
        if ($facilities->isEmpty()) {
            $this->command->error('Нет учреждений! Сначала создайте учреждения.');
            return;
        }
        
        $this->command->info('Найдено врачей: ' . $doctors->count());
        $this->command->info('Найдено учреждений: ' . $facilities->count());
        
        foreach ($doctors as $index => $doctor) {
            // Берем учреждение по индексу (циклически)
            $facility = $facilities[$index % $facilities->count()];
            
            // Проверяем, есть ли уже связь
            $exists = $doctor->facilities()->where('facility_id', $facility->id)->exists();
            
            if (!$exists) {
                $doctor->facilities()->attach($facility->id, [
                    'is_main_job' => true,
                    'role' => 'attending'
                ]);
                $this->command->info("✅ Врач '{$doctor->name}' привязан к учреждению '{$facility->name}'");
            } else {
                $this->command->info("⚠️ Связь уже существует: {$doctor->name} -> {$facility->name}");
            }
        }
        
        $this->command->info('🎉 Готово!');
    }
}