<?php

namespace App\Filament\Admin\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('age')
                    ->required()
                    ->numeric(),
                DatePicker::make('birth_date')
                    ->required(),
                Textarea::make('medical_history')
                    ->columnSpanFull(),
            ]);
    }
}
