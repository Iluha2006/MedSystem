<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Cabinet;
use App\Models\Facility;
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

        // Получаем facility_id для каждого здания
        $cabinets = [
            // Главный корпус (building_id = 1, facility_id = 1)
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '101', 
                'name' => 'Кардиологический кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '102', 
                'name' => 'Неврологический кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '103', 
                'name' => 'Терапевтический кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '104', 
                'name' => 'Процедурный кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '105', 
                'name' => 'Кабинет УЗИ', 
                'is_active' => true
            ],
            
            // Хирургический корпус (building_id = 1, но тот же facility)
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '201', 
                'name' => 'Хирургический кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '202', 
                'name' => 'Перевязочная', 
                'is_active' => true
            ],
            [
                'facility_id' => 1,
                'building_id' => 1, 
                'cabinet_number' => '203', 
                'name' => 'Кабинет гипсования', 
                'is_active' => true
            ],
            
            // Стационар (building_id = 2, facility_id = 2)
            [
                'facility_id' => 2,
                'building_id' => 2, 
                'cabinet_number' => '301', 
                'name' => 'Смотровой кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 2,
                'building_id' => 2, 
                'cabinet_number' => '302', 
                'name' => 'Кабинет заведующего', 
                'is_active' => true
            ],
            
            // Поликлиника (building_id = 3, facility_id = 3)
            [
                'facility_id' => 3,
                'building_id' => 3, 
                'cabinet_number' => '401', 
                'name' => 'Регистратура', 
                'is_active' => true
            ],
            [
                'facility_id' => 3,
                'building_id' => 3, 
                'cabinet_number' => '402', 
                'name' => 'Приемный кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 3,
                'building_id' => 3, 
                'cabinet_number' => '403', 
                'name' => 'Стоматологический кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 3,
                'building_id' => 3, 
                'cabinet_number' => '404', 
                'name' => 'Гинекологический кабинет', 
                'is_active' => true
            ],
            
            // Детский корпус (building_id = 4, facility_id = 4)
            [
                'facility_id' => 4,
                'building_id' => 4, 
                'cabinet_number' => '501', 
                'name' => 'Детский приемный кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 4,
                'building_id' => 4, 
                'cabinet_number' => '502', 
                'name' => 'Прививочный кабинет', 
                'is_active' => true
            ],
            [
                'facility_id' => 4,
                'building_id' => 4, 
                'cabinet_number' => '503', 
                'name' => 'Кабинет здорового ребенка', 
                'is_active' => true
            ],
        ];

        foreach ($cabinets as $cabinet) {
            Cabinet::firstOrCreate(
                [
                    'building_id' => $cabinet['building_id'],
                    'cabinet_number' => $cabinet['cabinet_number']
                ],
                $cabinet
            );
        }

        $this->command->info('✅ Кабинеты: ' . Cabinet::count());
    }
}