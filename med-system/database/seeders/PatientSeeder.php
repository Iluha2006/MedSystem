<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            ['name' => 'Иванов Иван Иванович', 'email' => 'ivanov@patient.com', 'birth_date' => '1989-05-15', 'age' => 35],
            ['name' => 'Петрова Анна Сергеевна', 'email' => 'petrova@patient.com', 'birth_date' => '1996-08-22', 'age' => 28],
            ['name' => 'Сидоров Петр Алексеевич', 'email' => 'sidorov@patient.com', 'birth_date' => '1979-03-10', 'age' => 45],
            ['name' => 'Кузнецова Елена Владимировна', 'email' => 'kuznetsova@patient.com', 'birth_date' => '1992-11-30', 'age' => 32],
            ['name' => 'Смирнов Дмитрий Николаевич', 'email' => 'smirnov@patient.com', 'birth_date' => '1972-07-18', 'age' => 52],
        ];

        foreach ($patients as $patientData) {
            $user = User::firstOrCreate(
                ['email' => $patientData['email']],
                ['name' => $patientData['name'], 'password' => Hash::make('password123')]
            );
            $user->assignRole('patient');

            Patient::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $patientData['name'],
                    'birth_date' => $patientData['birth_date'],
                    'age' => $patientData['age'],
                ]
            );
        }

        $this->command->info('✅ Пациенты: ' . Patient::count());
    }
}