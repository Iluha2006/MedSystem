<?php

namespace App\Filament\Admin\Resources\OutpatientVisits\Pages;

use App\Filament\Admin\Resources\OutpatientVisits\OutpatientVisitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOutpatientVisits extends ListRecords
{
    protected static string $resource = OutpatientVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
