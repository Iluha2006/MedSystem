<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\OutpatientVisit;
use App\Models\Operation;
use App\Models\InpatientStay;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Пациенты', Patient::count())
                ->description('Всего в системе')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),
            
            Stat::make('Врачи', Doctor::count())
                ->description('Активных специалистов')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary'),
            
            Stat::make('Записи ', OutpatientVisit::whereDate('visit_date', today())->count())
               
                ->descriptionIcon('heroicon-o-calendar')
                ->color('warning'),
                 
            Stat::make('Операции', Operation::count())
                ->description('Всего проведено')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('danger'),
            
            Stat::make('В стационаре', InpatientStay::whereNull('discharge_date')->count())
                ->description('Текущих пациентов')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('info'),
            
            Stat::make('Пользователей', User::count())
                ->description('Зарегистрировано')
                ->descriptionIcon('heroicon-o-users')
                ->color('gray'),
        ];
    }
}