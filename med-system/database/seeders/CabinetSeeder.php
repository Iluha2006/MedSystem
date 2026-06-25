<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Cabinet;
use Illuminate\Database\Seeder;

class CabinetSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = Building::all();

        if ($buildings->isEmpty()) {
            $this->command->warn('⚠️ Сначала запустите BuildingSeeder!');
            return;
        }

        $cabinetNames = [
            'Терапевтический кабинет',
            'Хирургический кабинет',
            'Смотровой кабинет',
            'Процедурный кабинет',
            'Прививочный кабинет',
            'Кабинет УЗИ',
            'Кабинет функциональной диагностики',
            'Приемный кабинет',
            'Перевязочная',
            'Кабинет заведующего',
        ];

        foreach ($buildings as $building) {
            for ($i = 0; $i < min(2, count($cabinetNames)); $i++) {
                $index = ($building->id * 2 + $i) % count($cabinetNames);
                Cabinet::firstOrCreate(
                    [
                        'building_id' => $building->id,
                        'cabinet_number' => strval($building->id * 100 + $i + 1),
                    ],
                    [
                        'facility_id' => $building->facility_id,
                        'building_id' => $building->id,
                        'cabinet_number' => strval($building->id * 100 + $i + 1),
                        'name' => $cabinetNames[$index],
                        'is_active' => true,
                    ]
                );
            }
        }

        $this->command->info('✅ Кабинеты: ' . Cabinet::count());
    }
}
