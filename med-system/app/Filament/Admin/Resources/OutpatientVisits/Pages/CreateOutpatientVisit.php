<?php

namespace App\Filament\Admin\Resources\OutpatientVisits\Pages;

use App\Filament\Admin\Resources\OutpatientVisits\OutpatientVisitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOutpatientVisit extends CreateRecord
{
    protected static string $resource = OutpatientVisitResource::class;

    protected static bool $canCreateAnother = false;
}
