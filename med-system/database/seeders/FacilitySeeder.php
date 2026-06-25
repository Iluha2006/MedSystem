<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'Городская больница №1', 'type' => 'hospital', 'address' => 'ул. Ленина, 10'],
            ['name' => 'Областная больница', 'type' => 'hospital', 'address' => 'пр. Невский, 25'],
            ['name' => 'Центральная поликлиника', 'type' => 'polyclinic', 'address' => 'ул. Советская, 15'],
            ['name' => 'Детская больница', 'type' => 'hospital', 'address' => 'ул. Медиков, 5'],
            ['name' => 'Кардиологический центр', 'type' => 'hospital', 'address' => 'ул. Здоровья, 8'],
            ['name' => 'Онкологический диспансер', 'type' => 'hospital', 'address' => 'ул. Мира, 12'],
            ['name' => 'Стоматологическая клиника', 'type' => 'polyclinic', 'address' => 'ул. Центральная, 3'],
            ['name' => 'Инфекционная больница', 'type' => 'hospital', 'address' => 'ул. Окружная, 7'],
            ['name' => 'Перинатальный центр', 'type' => 'hospital', 'address' => 'ул. Родильная, 1'],
            ['name' => 'Кожно-венерологический диспансер', 'type' => 'polyclinic', 'address' => 'ул. Южная, 14'],
        ];

        foreach ($facilities as $facility) {
            Facility::firstOrCreate(['name' => $facility['name']], $facility);
        }

        $this->command->info('✅ Учреждения: ' . Facility::count());
    }
}