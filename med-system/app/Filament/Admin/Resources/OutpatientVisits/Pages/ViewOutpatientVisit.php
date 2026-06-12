<?php

namespace App\Filament\Admin\Resources\OutpatientVisits\Pages;

use App\Filament\Admin\Resources\OutpatientVisits\OutpatientVisitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOutpatientVisit extends ViewRecord
{
    protected static string $resource = OutpatientVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
