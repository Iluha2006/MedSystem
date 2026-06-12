<?php

namespace App\Filament\Admin\Resources\Beds\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BedForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ward_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bed_number')
                    ->required(),
                Toggle::make('is_occupied')
                    ->required(),
            ]);
    }
}
