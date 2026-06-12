<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['building_id' => 1, 'name' => 'Кардиология', 'specialization' => 'Сердечно-сосудистые заболевания'],
            ['building_id' => 1, 'name' => 'Неврология', 'specialization' => 'Заболевания нервной системы'],
            ['building_id' => 2, 'name' => 'Хирургия', 'specialization' => 'Общая хирургия'],
            ['building_id' => 3, 'name' => 'Терапия', 'specialization' => 'Общая терапия'],
            ['building_id' => 4, 'name' => 'Педиатрия', 'specialization' => 'Детские болезни'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(['name' => $department['name']], $department);
        }

        $this->command->info('✅ Отделы: ' . Department::count());
    }
}