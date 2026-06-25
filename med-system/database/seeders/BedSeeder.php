<?php

namespace Database\Seeders;

use App\Models\Bed;
use Illuminate\Database\Seeder;

class BedSeeder extends Seeder
{
    public function run(): void
    {
        $wardIds = \App\Models\Ward::pluck('id')->toArray();

        if (empty($wardIds)) {
            $this->command->warn('⚠️ Сначала запустите WardSeeder!');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            Bed::create([
                'ward_id' => $wardIds[array_rand($wardIds)],
                'bed_number' => $i,
                'is_occupied' => (bool) rand(0, 1),
            ]);
        }

        $this->command->info('✅ Койки: ' . Bed::count());
    }
}