<?php

namespace App\Filament\Admin\Resources\Doctors\Pages;

use App\Filament\Admin\Resources\DoctorResource as ResourcesDoctorResource;
use App\Filament\Admin\Resources\Doctors\DoctorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDoctor extends ViewRecord
{
    protected static string $resource = ResourcesDoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
