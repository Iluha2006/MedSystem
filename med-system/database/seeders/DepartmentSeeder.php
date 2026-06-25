<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $buildingDepartments = [
            'Главный корпус' => [
                ['name' => 'Терапевтическое отделение', 'specialization' => 'Общая терапия'],
                ['name' => 'Неврологическое отделение', 'specialization' => 'Заболевания нервной системы'],
                ['name' => 'Диагностическое отделение', 'specialization' => 'Функциональная диагностика'],
            ],
            'Хирургический корпус' => [
                ['name' => 'Хирургическое отделение', 'specialization' => 'Общая хирургия'],
                ['name' => 'Травматологическое отделение', 'specialization' => 'Травмы и ортопедия'],
                ['name' => 'Реанимационное отделение', 'specialization' => 'Интенсивная терапия'],
            ],
            'Стационар' => [
                ['name' => 'Приёмное отделение', 'specialization' => 'Экстренная помощь'],
                ['name' => 'Реанимация', 'specialization' => 'Интенсивная терапия'],
            ],
            'Поликлиника' => [
                ['name' => 'Консультативное отделение', 'specialization' => 'Консультативная помощь'],
                ['name' => 'Отделение профилактики', 'specialization' => 'Профилактика заболеваний'],
            ],
            'Детский корпус' => [
                ['name' => 'Педиатрическое отделение', 'specialization' => 'Детские болезни'],
                ['name' => 'Детская реанимация', 'specialization' => 'Детская интенсивная терапия'],
            ],
            'Кардиологический корпус' => [
                ['name' => 'Кардиологическое отделение', 'specialization' => 'Сердечно-сосудистые заболевания'],
                ['name' => 'Кардиохирургическое отделение', 'specialization' => 'Хирургия сердца и сосудов'],
            ],
            'Онкологический корпус' => [
                ['name' => 'Онкологическое отделение', 'specialization' => 'Лечение опухолей'],
                ['name' => 'Химиотерапевтическое отделение', 'specialization' => 'Химиотерапия'],
            ],
            'Стоматологический корпус' => [
                ['name' => 'Терапевтическая стоматология', 'specialization' => 'Лечение зубов'],
                ['name' => 'Хирургическая стоматология', 'specialization' => 'Удаление и имплантация'],
            ],
            'Инфекционный корпус' => [
                ['name' => 'Инфекционное отделение', 'specialization' => 'Инфекционные заболевания'],
                ['name' => 'Боксовое отделение', 'specialization' => 'Особо опасные инфекции'],
            ],
            'Родильный корпус' => [
                ['name' => 'Акушерское отделение', 'specialization' => 'Беременность и роды'],
                ['name' => 'Гинекологическое отделение', 'specialization' => 'Женские заболевания'],
                ['name' => 'Отделение новорождённых', 'specialization' => 'Уход за новорождёнными'],
            ],
        ];

        $buildings = Building::all();

        foreach ($buildings as $building) {
            $departments = $buildingDepartments[$building->name] ?? [
                ['name' => 'Основное отделение', 'specialization' => 'Общий профиль'],
            ];

            foreach ($departments as $department) {
                Department::firstOrCreate(
                    ['building_id' => $building->id, 'name' => $department['name']],
                    ['specialization' => $department['specialization']]
                );
            }
        }

        $this->command->info('✅ Отделения: ' . Department::count());
    }
}