<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Degree;
use App\Models\AcademicTitle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            ['name' => 'Иванов Иван Иванович', 'email' => 'ivanov@doctor.com', 'specialty' => 'Кардиолог', 'exp' => 25],
            ['name' => 'Петров Петр Петрович', 'email' => 'petrov@doctor.com', 'specialty' => 'Хирург', 'exp' => 20],
            ['name' => 'Сидорова Анна Сергеевна', 'email' => 'sidorova@doctor.com', 'specialty' => 'Невролог', 'exp' => 15],
            ['name' => 'Кузнецова Елена Владимировна', 'email' => 'kuznetsova@doctor.com', 'specialty' => 'Терапевт', 'exp' => 12],
            ['name' => 'Смирнов Дмитрий Николаевич', 'email' => 'smirnov@doctor.com', 'specialty' => 'Педиатр', 'exp' => 10],
            ['name' => 'Козлов Андрей Михайлович', 'email' => 'kozlov@doctor.com', 'specialty' => 'Офтальмолог', 'exp' => 18],
            ['name' => 'Морозова Ольга Игоревна', 'email' => 'morozova@doctor.com', 'specialty' => 'Отоларинголог', 'exp' => 14],
            ['name' => 'Волков Сергей Павлович', 'email' => 'volkov@doctor.com', 'specialty' => 'Дерматолог', 'exp' => 22],
            ['name' => 'Белова Татьяна Викторовна', 'email' => 'belova@doctor.com', 'specialty' => 'Эндокринолог', 'exp' => 16],
            ['name' => 'Зайцева Марина Алексеевна', 'email' => 'zaytseva@doctor.com', 'specialty' => 'Гинеколог', 'exp' => 19],
        ];

        $specialtyMap = Specialty::pluck('id', 'name')->toArray();
        $degree = Degree::where('name', 'Кандидат медицинских наук')->first();
        $title = AcademicTitle::where('name', 'Доцент')->first();

        foreach ($doctors as $doctorData) {
            $user = User::firstOrCreate(
                ['email' => $doctorData['email']],
                ['name' => $doctorData['name'], 'password' => Hash::make('password123')]
            );
            $user->assignRole('doctor');

            Doctor::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $doctorData['name'],
                    'specialty_id' => $specialtyMap[$doctorData['specialty']],
                    'degree_id' => $degree?->id,
                    'academic_title_id' => $title?->id,
                    'experience_years' => $doctorData['exp'],
                    'hazard_coeff' => 0,
                ]
            );
        }

        $this->command->info('✅ Врачи: ' . Doctor::count());
    }
}