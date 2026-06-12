<?php

namespace Database\Seeders;

use App\Models\AcademicTitle;
use Illuminate\Database\Seeder;

class AcademicTitleSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            ['name' => 'Профессор'],
            ['name' => 'Доцент'],
            ['name' => 'Ассистент'],
            ['name' => 'Без звания'],
        ];

        foreach ($titles as $title) {
            AcademicTitle::firstOrCreate(['name' => $title['name']]);
        }

        $this->command->info('✅ Ученые звания: ' . AcademicTitle::count());
    }
}