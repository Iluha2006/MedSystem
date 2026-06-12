<?php

namespace App\Filament\Admin\Resources\Facilities\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FacilitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Название'),
                TextColumn::make('type')
                    ->searchable()
                    ->label('Тип'),
                TextColumn::make('parentHospital.name')
                    ->searchable()
                    ->label('Головная больница'),
                TextColumn::make('address')
                    ->searchable()
                    ->label('Адрес'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Создан'),
            ])
            ->filters([
                //
            ])
         
            ->actions([
                ViewAction::make()
                    ->label('')
                    ->tooltip('Просмотр'),
                EditAction::make()
                    ->label('')
                    ->tooltip('Редактировать'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}