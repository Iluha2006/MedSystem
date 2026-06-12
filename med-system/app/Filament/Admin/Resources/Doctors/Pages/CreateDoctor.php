<?php

namespace App\Filament\Admin\Resources\Doctors\Pages;

use App\Filament\Admin\Resources\DoctorResource as ResourcesDoctorResource;
use App\Filament\Admin\Resources\Doctors\DoctorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDoctor extends CreateRecord
{
    protected static string $resource = ResourcesDoctorResource::class;
}
