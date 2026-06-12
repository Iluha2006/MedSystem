<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Ward::create([
                'department_id' => rand(1, 5),
                'ward_number' => $i,
                'capacity' => rand(2, 6),
            ]);
        }

        $this->command->info('✅ Палаты: ' . Ward::count());
    }
}