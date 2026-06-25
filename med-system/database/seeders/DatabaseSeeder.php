<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
        $this->call(SpecialtySeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(AcademicTitleSeeder::class);
        
   
        $this->call(RolesSeeder::class);
        
        $this->call(FacilitySeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(WardSeeder::class);
        $this->call(BedSeeder::class);
        $this->call(CabinetSeeder::class);

        $this->call(LaboratorySeeder::class);
        
    
        $this->call(DoctorSeeder::class);
        $this->call(DoctorFacilitySeeder::class);
        $this->call(PatientSeeder::class);
        
        $this->call(OutpatientVisitSeeder::class);
        $this->call(OperationSeeder::class);
        $this->call(InpatientStaySeeder::class);
        
        $this->command->info('🎉 Все сидеры выполнены!');
    }
}