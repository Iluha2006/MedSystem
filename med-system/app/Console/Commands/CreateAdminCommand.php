<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminCommand extends Command
{
    protected $signature = 'make:admin 
                            {email? : Email администратора} 
                            {name? : Имя администратора} 
                            {--password= : Пароль администратора}';
    
    protected $description = 'Создать администратора для Filament';

    public function handle()
    {
        // Получаем email
        $email = $this->argument('email') ?? $this->ask('Email администратора', 'admin@example.com');
        
        // Получаем имя
        $name = $this->argument('name') ?? $this->ask('Имя администратора', 'Администратор');
        
        // Получаем пароль
        $password = $this->option('password') ?? $this->secret('Пароль администратора (минимум 6 символов)');
        
        if (!$password) {
            $password = 'password123';
            $this->warn('Пароль не указан, установлен по умолчанию: password123');
        }
        
        if (strlen($password) < 6) {
            $this->error('Пароль должен быть не менее 6 символов!');
            return 1;
        }
        
        // Проверяем, существует ли пользователь
        $user = User::where('email', $email)->first();
        
        if ($user) {
            if ($this->confirm("Пользователь {$email} уже существует. Назначить ему роль admin?")) {
                $user->assignRole('admin');
                $this->info("✅ Роль admin назначена пользователю {$email}");
                $this->info("📧 Email: {$email}");
                $this->info("🔑 Пароль: {$password}");
            }
            return 0;
        }
        
        // Создаем пользователя
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        
        // Назначаем роль admin
        $user->assignRole('admin');
        
        $this->info("✅ Администратор успешно создан!");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("📧 Email: {$email}");
        $this->info("👤 Имя: {$name}");
        $this->info("🔑 Пароль: {$password}");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("🔗 Вход в админ-панель: " . url('/admin'));
        
        return 0;
    }
}