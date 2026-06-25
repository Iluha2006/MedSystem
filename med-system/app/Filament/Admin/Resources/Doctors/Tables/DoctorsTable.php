<?php

namespace App\Filament\Admin\Resources\Doctors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DoctorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('degree_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('academic_title_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('specialty_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('experience_years')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hazard_coeff')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('surgeries_performed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('surgeries_fatal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('extra_vacation_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
