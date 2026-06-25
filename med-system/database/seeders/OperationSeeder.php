<?php

namespace Database\Seeders;

use App\Models\Operation;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
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

        $operations = [
            [
                'name' => 'Аппендэктомия',
                'operation_type' => 'экстренная',
                'diagnosis' => 'Острый аппендицит',
                'description' => 'Удаление червеобразного отростка',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Холецистэктомия',
                'operation_type' => 'плановая',
                'diagnosis' => 'Калькулезный холецистит',
                'description' => 'Лапароскопическое удаление желчного пузыря',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Кесарево сечение',
                'operation_type' => 'экстренная',
                'diagnosis' => 'Слабость родовой деятельности',
                'description' => 'Оперативное родоразрешение',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Грыжесечение',
                'operation_type' => 'плановая',
                'diagnosis' => 'Паховая грыжа',
                'description' => 'Пластика грыжевых ворот',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => 'Послеоперационный отек',
            ],
            [
                'name' => 'Эндоскопическая полипэктомия',
                'operation_type' => 'плановая',
                'diagnosis' => 'Полип желудка',
                'description' => 'Удаление полипа через эндоскоп',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Тонзиллэктомия',
                'operation_type' => 'плановая',
                'diagnosis' => 'Хронический тонзиллит',
                'description' => 'Удаление небных миндалин',
                'result' => 'complicated',
                'is_fatal' => false,
                'complications' => 'Кровотечение',
            ],
            [
                'name' => 'Остеосинтез бедра',
                'operation_type' => 'экстренная',
                'diagnosis' => 'Перелом шейки бедра',
                'description' => 'Фиксация отломков металлоконструкцией',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Резекция желудка',
                'operation_type' => 'плановая',
                'diagnosis' => 'Язвенная болезнь желудка',
                'description' => 'Дистальная резекция желудка',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
            [
                'name' => 'Трансплантация почки',
                'operation_type' => 'плановая',
                'diagnosis' => 'Хроническая почечная недостаточность',
                'description' => 'Пересадка донорской почки',
                'result' => 'complicated',
                'is_fatal' => false,
                'complications' => 'Реакция отторжения',
            ],
            [
                'name' => 'Ампутация нижней конечности',
                'operation_type' => 'экстренная',
                'diagnosis' => 'Сахарный диабет, гангрена стопы',
                'description' => 'Ампутация на уровне голени',
                'result' => 'successful',
                'is_fatal' => false,
                'complications' => null,
            ],
        ];

        foreach ($operations as $i => $opData) {
            Operation::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'facility_id' => $facilities->random()->id,
                'operation_date' => now()->subDays(rand(1, 365))->setTime(rand(8, 16), 0, 0),
                'name' => $opData['name'],
                'operation_type' => $opData['operation_type'],
                'diagnosis' => $opData['diagnosis'],
                'description' => $opData['description'],
                'result' => $opData['result'],
                'is_fatal' => $opData['is_fatal'],
                'complications' => $opData['complications'],
            ]);
        }

        $this->command->info('✅ Операции: ' . Operation::count());
    }
}
