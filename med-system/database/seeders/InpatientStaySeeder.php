<?php

namespace Database\Seeders;

use App\Models\InpatientStay;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class InpatientStaySeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        if ($patients->isEmpty() || $doctors->isEmpty()) {
            $this->command->warn('⚠️ Сначала создайте пациентов и врачей!');
            return;
        }

        $conditions = [
            'Состояние средней тяжести',
            'Удовлетворительное',
            'Тяжелое',
            'Стабильное',
            'Легкой степени тяжести',
        ];

        // 7 активных (еще в больнице) + 3 выписанных
        for ($i = 0; $i < 10; $i++) {
            $isActive = $i < 7;
            $admissionDate = now()->subDays(rand(1, 20));

            InpatientStay::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'admission_date' => $admissionDate,
                'discharge_date' => $isActive ? null : (clone $admissionDate)->addDays(rand(3, 14)),
                'condition' => $conditions[array_rand($conditions)],
                'temperature' => round(36.0 + mt_rand() / mt_getrandmax() * 3, 1),
            ]);
        }

        $this->command->info('✅ Госпитализации: ' . InpatientStay::count());
    }
}
