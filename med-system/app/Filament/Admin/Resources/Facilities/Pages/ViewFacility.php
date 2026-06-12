<?php

namespace App\Filament\Admin\Resources\Facilities\Pages;

use App\Filament\Admin\Resources\Facilities\FacilityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFacility extends ViewRecord
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
