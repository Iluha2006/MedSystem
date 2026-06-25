<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    public function run(): void
    {
        $departmentIds = \App\Models\Department::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            Ward::create([
                'department_id' => $departmentIds[array_rand($departmentIds)],
                'ward_number' => (string) $i,
                'capacity' => rand(2, 6),
            ]);
        }

        $this->command->info('✅ Палаты: ' . Ward::count());
    }
}