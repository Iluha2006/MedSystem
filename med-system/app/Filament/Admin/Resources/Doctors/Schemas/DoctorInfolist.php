<?php

namespace App\Filament\Admin\Resources\Doctors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DoctorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('degree_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('academic_title_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('specialty_id')
                    ->numeric(),
                TextEntry::make('experience_years')
                    ->numeric(),
                TextEntry::make('hazard_coeff')
                    ->numeric(),
                TextEntry::make('surgeries_performed')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('surgeries_fatal')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('extra_vacation_days')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
