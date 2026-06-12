<?php

namespace App\Filament\Admin\Resources\Departments\Pages;

use App\Filament\Admin\Resources\Departments\DepartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Override;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }


    
    #[Override]
    protected function getSavedNotification(): ?Notification
    {
          return Notification::make()
            ->success()
            ->title("Отделение обновлено")
            ->body("Отделение \"{$this->record->name}\" успешно изменено")
            ->duration(5000);
    }

      protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");
    }
    
}
