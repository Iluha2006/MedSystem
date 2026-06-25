<?php

namespace App\Filament\Admin\Resources\Departments\Pages;

use App\Filament\Admin\Resources\Departments\DepartmentResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Override;

class CreateDepartment extends CreateRecord
{
    protected static string $resource = DepartmentResource::class;

    protected static bool $canCreateAnother = false;

    
    #[Override]
    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title("Отделение создано")
        ->body("Отделение \"{$this->record->name}\" успешно создано")
        ->duration(5000); 
}

    #[Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");
    }
    
    
    
 
    protected function mutateFormDataBeforeCreate(array $data): array
    {
      
        $data['created_by'] = auth()->id();
        
        return $data;
    }
}