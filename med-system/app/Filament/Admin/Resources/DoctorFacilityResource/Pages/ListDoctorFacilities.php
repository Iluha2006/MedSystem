<?php

namespace App\Filament\Admin\Resources\DoctorFacilityResource\Pages;

use App\Filament\Admin\Resources\DoctorFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDoctorFacilities extends ListRecords
{
    protected static string $resource = DoctorFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
