<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        $degrees = [
            ['name' => 'Доктор медицинских наук'],
            ['name' => 'Кандидат медицинских наук'],
            ['name' => 'Без степени'],
        ];

        foreach ($degrees as $degree) {
            Degree::firstOrCreate(['name' => $degree['name']]);
        }

        $this->command->info('✅ Ученые степени: ' . Degree::count());
    }
}