<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    public function run(): void
    {
        $laboratories = [
            ['name' => 'Биохимическая лаборатория №1', 'profile' => 'biochemical'],
            ['name' => 'Физиологическая лаборатория', 'profile' => 'physiological'],
            ['name' => 'Химическая лаборатория', 'profile' => 'chemical'],
            ['name' => 'Биохимическая лаборатория №2', 'profile' => 'biochemical'],
            ['name' => 'Центральная физиологическая лаборатория', 'profile' => 'physiological'],
        ];

        foreach ($laboratories as $laboratory) {
            Laboratory::firstOrCreate(['name' => $laboratory['name']], $laboratory);
        }

        $this->command->info('Лаборатории: ' . Laboratory::count());
    }
}
