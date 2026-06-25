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
            ['name' => 'Иванов Иван Иванович', 'email' => 'ivanov@patient.com', 'birth_date' => '1989-05-15', 'age' => 35, 'medical_history' => 'Гипертоническая болезнь II стадии. Хронический гастрит.'],
            ['name' => 'Петрова Анна Сергеевна', 'email' => 'petrova@patient.com', 'birth_date' => '1996-08-22', 'age' => 28, 'medical_history' => 'Бронхиальная астма. Аллергический ринит.'],
            ['name' => 'Сидоров Петр Алексеевич', 'email' => 'sidorov@patient.com', 'birth_date' => '1979-03-10', 'age' => 45, 'medical_history' => 'Сахарный диабет 2 типа. Ожирение I степени.'],
            ['name' => 'Кузнецова Елена Владимировна', 'email' => 'kuznetsova@patient.com', 'birth_date' => '1992-11-30', 'age' => 32, 'medical_history' => 'Хронический пиелонефрит. Анемия легкой степени.'],
            ['name' => 'Смирнов Дмитрий Николаевич', 'email' => 'smirnov@patient.com', 'birth_date' => '1972-07-18', 'age' => 52, 'medical_history' => 'Ишемическая болезнь сердца. Атеросклероз.'],
            ['name' => 'Тимофеев Алексей Викторович', 'email' => 'timofeev@patient.com', 'birth_date' => '1985-03-22', 'age' => 41, 'medical_history' => 'Язвенная болезнь желудка. Панкреатит.'],
            ['name' => 'Андреева Наталья Игоревна', 'email' => 'andreeva@patient.com', 'birth_date' => '1999-11-05', 'age' => 26, 'medical_history' => 'Вегетососудистая дистония. Хронический тонзиллит.'],
            ['name' => 'Федоров Михаил Сергеевич', 'email' => 'fedorov@patient.com', 'birth_date' => '1965-08-30', 'age' => 59, 'medical_history' => 'ХОБЛ. Эмфизема легких. Хронический бронхит.'],
            ['name' => 'Григорьева Ольга Павловна', 'email' => 'grigorieva@patient.com', 'birth_date' => '1978-12-12', 'age' => 47, 'medical_history' => 'Остеохондроз. Артроз коленных суставов.'],
            ['name' => 'Николаев Артем Денисович', 'email' => 'nikolaev@patient.com', 'birth_date' => '2003-06-18', 'age' => 22, 'medical_history' => 'Частые ОРВИ. Аденоидит.'],
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
                    'medical_history' => $patientData['medical_history'],
                ]
            );
        }

        $this->command->info('✅ Пациенты: ' . Patient::count());
    }
}