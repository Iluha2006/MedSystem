<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = Facility::all();
        
        $buildings = [
            ['facility_id' => 1, 'name' => 'Главный корпус'],
            ['facility_id' => 1, 'name' => 'Хирургический корпус'],
            ['facility_id' => 2, 'name' => 'Стационар'],
            ['facility_id' => 3, 'name' => 'Поликлиника'],
            ['facility_id' => 4, 'name' => 'Детский корпус'],
            ['facility_id' => 5, 'name' => 'Кардиологический корпус'],
            ['facility_id' => 6, 'name' => 'Онкологический корпус'],
            ['facility_id' => 7, 'name' => 'Стоматологический корпус'],
            ['facility_id' => 8, 'name' => 'Инфекционный корпус'],
            ['facility_id' => 9, 'name' => 'Родильный корпус'],
        ];

        foreach ($buildings as $building) {
            Building::firstOrCreate(['name' => $building['name']], $building);
        }

        $this->command->info('✅ Здания: ' . Building::count());
    }
}