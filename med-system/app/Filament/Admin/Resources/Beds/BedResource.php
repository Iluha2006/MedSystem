<?php

namespace App\Filament\Admin\Resources\Beds;

use App\Filament\Admin\Resources\Beds\Pages\CreateBed;
use App\Filament\Admin\Resources\Beds\Pages\EditBed;
use App\Filament\Admin\Resources\Beds\Pages\ListBeds;
use App\Models\Bed;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BedResource extends Resource
{
    protected static ?string $model = Bed::class;
    
  
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Койка';
    protected static ?string $navigationGroup = 'Стационар';
    protected static ?int $navigationSort = 2;
    
 
    protected static ?string $modelLabel = 'Койка';
    protected static ?string $pluralModelLabel = 'Койки';
    
 
    protected static ?string $recordTitleAttribute = 'bed_number'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('ward_id')
                    ->relationship('ward', 'ward_number')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Палата'), // 👈 Подпись поля
                    
                \Filament\Forms\Components\TextInput::make('bed_number')
                    ->required()
                    ->maxLength(255)
                    ->label('Номер койки'), // 👈 Подпись поля
                    
                \Filament\Forms\Components\Toggle::make('is_occupied')
                    ->default(false)
                    ->label('Занята')
                    ->helperText('Отметьте, если койка занята пациентом'), // 👈 Подсказка
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ward.ward_number')
                    ->label('Палата')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('bed_number')
                    ->label('Номер койки') 
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\IconColumn::make('is_occupied')
                    ->boolean()
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->label('Статус')
                    ->tooltip('Занята или свободна'), 
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_occupied')
                    ->label('Статус')
                    ->trueLabel('Занятые')
                    ->falseLabel('Свободные')
                    ->placeholder('Все койки')
                    ->native(),
                    
                Tables\Filters\SelectFilter::make('ward_id')
                    ->relationship('ward', 'ward_number')
                    ->label('Палата')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->tooltip('Просмотр койки'),
                    
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Редактировать койку'),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Удалить койку')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Удалить выбранные')
                        ->tooltip('Удалить отмеченные койки'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBeds::route('/'),
            'create' => CreateBed::route('/create'),
            'edit' => EditBed::route('/{record}/edit'),
        ];
    }
    
  
}