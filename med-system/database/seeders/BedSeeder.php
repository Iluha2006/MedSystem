<?php

namespace Database\Seeders;

use App\Models\Bed;
use Illuminate\Database\Seeder;

class BedSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Bed::create([
                'ward_id' => rand(1, 5),
                'bed_number' => $i,
                'is_occupied' => (bool) rand(0, 1),
            ]);
        }

        $this->command->info('✅ Койки: ' . Bed::count());
    }
}