<?php

namespace App\Filament\Admin\Resources\DoctorFacilityResource\Pages;

use App\Filament\Admin\Resources\DoctorFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDoctorFacility extends EditRecord
{
    protected static string $resource = DoctorFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
