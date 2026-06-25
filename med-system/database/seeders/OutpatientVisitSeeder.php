<?php

namespace Database\Seeders;

use App\Models\OutpatientVisit;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class OutpatientVisitSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $facilities = Facility::all();

        if ($patients->isEmpty() || $doctors->isEmpty()) {
            $this->command->warn('⚠️ Сначала создайте пациентов и врачей!');
            return;
        }

        $statuses = ['scheduled', 'confirmed', 'completed', 'cancelled'];
        $complaints = [
            'Болит голова уже неделю',
            'Беспокоят боли в спине',
            'Повышенное давление',
            'Боли в области сердца',
            'Температура держится несколько дней',
            'Беспокоит кашель',
            'Боли в желудке после еды',
            'Кожная сыпь',
            'Головокружение при вставании',
            'Ухудшение зрения',
        ];
        $diagnoses = [
            'Гипертоническая болезнь',
            'Остеохондроз позвоночника',
            'ОРВИ',
            'Гастрит',
            'Аллергический дерматит',
            'Мигрень',
            'Хронический бронхит',
            'Анемия легкой степени',
            'Вегетососудистая дистония',
            'Конъюнктивит',
        ];
        $prescriptions = [
            'Принимать по 1 таблетке 2 раза в день',
            'Постельный режим, обильное питье',
            'Физиотерапия, ЛФК',
            'Диета стол №5',
            'Мази наружно 2 раза в день',
            'Наблюдение у невролога',
            'Ингаляции 3 раза в день',
            'Препараты железа курсом 1 месяц',
            'Физкультура, закаливание',
            'Капли в глаза 3 раза в день',
        ];

        for ($i = 0; $i < 10; $i++) {
            $patient = $patients->random();
            $doctor = $doctors->random();
            $facility = $facilities->random();

            OutpatientVisit::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'facility_id' => $facility->id,
                'assigned_cabinet_id' => null,
                'visit_date' => now()->addDays(rand(1, 30))->setTime(rand(8, 17), rand(0, 3) * 15, 0),
                'complaint' => $complaints[$i],
                'diagnosis' => rand(0, 1) ? $diagnoses[$i] : null,
                'prescription' => rand(0, 1) ? $prescriptions[$i] : null,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        $this->command->info('✅ Амбулаторные приёмы: ' . OutpatientVisit::count());
    }
}
