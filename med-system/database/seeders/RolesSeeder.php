<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view users', 'create users', 'edit users', 'delete users',
            'view patients', 'create patients', 'edit patients', 'delete patients',
            'view appointments', 'create appointments', 'edit appointments', 'delete appointments',
            'view medical_records', 'create medical_records', 'edit medical_records',
            'view reports', 'create reports', 'export reports',
            'view doctors', 'create doctors', 'edit doctors', 'delete doctors',
        ];
        
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }
        
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());
        
        $doctorRole = Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'web']);
        $doctorRole->syncPermissions([
            'view patients', 'view appointments', 'create appointments',
            'edit appointments', 'view medical_records', 'create medical_records',
            'view doctors', 'view reports',
        ]);
        
        $patientRole = Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);
        $patientRole->syncPermissions([
            'view appointments', 'create appointments', 'delete appointments', 'view medical_records',
        ]);

        $this->command->info('✅ Роли и разрешения созданы!');
    }
}