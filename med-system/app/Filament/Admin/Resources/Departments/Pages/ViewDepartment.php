<?php

namespace App\Filament\Admin\Resources\Departments\Pages;

use App\Filament\Admin\Resources\Departments\DepartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartment extends ViewRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [       
            DeleteAction::make(),
           EditAction::make()
        ];
    }

    
}
