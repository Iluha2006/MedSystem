<?php

namespace App\Filament\Admin\Resources\Doctors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('degree_id')
                    ->numeric(),
                TextInput::make('academic_title_id')
                    ->numeric(),
                TextInput::make('specialty_id')
                    ->required()
                    ->numeric(),
                TextInput::make('experience_years')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('hazard_coeff')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('surgeries_performed')
                    ->numeric(),
                TextInput::make('surgeries_fatal')
                    ->numeric(),
                TextInput::make('extra_vacation_days')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
