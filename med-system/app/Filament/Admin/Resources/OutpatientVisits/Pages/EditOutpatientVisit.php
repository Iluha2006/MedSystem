<?php

namespace App\Filament\Admin\Resources\OutpatientVisits\Pages;

use App\Filament\Admin\Resources\OutpatientVisits\OutpatientVisitResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOutpatientVisit extends EditRecord
{
    protected static string $resource = OutpatientVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [ DeleteAction::make()];
    }
}
