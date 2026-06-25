<?php

namespace App\Filament\Admin\Resources;


use App\Filament\Resources\BuildingResource\Pages\CreateBuilding;
use App\Filament\Resources\BuildingResource\Pages\EditBuilding;
use App\Filament\Resources\BuildingResource\Pages\ListBuildings;
use App\Models\Building;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Override;

class BuildingResource extends Resource
{
    protected static ?string $model = Building::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static $navigationGroup = 'Учреждение';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Корпус';

    protected static ?string $modelLabel = 'Корпус';

    protected static ?string $pluralModelLabel = 'Корпуса';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('facility_id')
                    ->relationship('facility', 'name')
                    ->label('Учреждение')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->helperText('Только больницы могут иметь корпуса'),
                
                Forms\Components\TextInput::make('name')
                    ->label('Название корпуса')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Корпус А, Главный корпус и т.д.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('facility.name')
                    ->label('Учреждение')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('departments_count')
                    ->label('Отделений')
                    ->counts('departments')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('facility')
                    ->relationship('facility', 'name')
                    ->label('Учреждение'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBuildings::route('/'),
            'create' => CreateBuilding::route('/create'),
            'edit' =>   EditBuilding::route('/{record}/edit'),
        ];
    }

  
}