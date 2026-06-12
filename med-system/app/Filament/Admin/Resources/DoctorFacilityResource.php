<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DoctorFacilityResource\Pages\CreateDoctorFacility;
use App\Filament\Admin\Resources\DoctorFacilityResource\Pages\EditDoctorFacility;
use App\Filament\Admin\Resources\DoctorFacilityResource\Pages\ListDoctorFacilities;
use App\Models\DoctorFacility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DoctorFacilityResource extends Resource
{
    protected static ?string $model = DoctorFacility::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Персонал';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Места работы врачей';

    protected static ?string $modelLabel = 'Место работы';

    protected static ?string $pluralModelLabel = 'Места работы врачей';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'name') 
                    ->label('Врач')
                    ->required()
                    ->searchable()
                    ->preload(),
                
                Forms\Components\Select::make('facility_id')
                    ->relationship('facility', 'name')
                    ->label('Учреждение')
                    ->required()
                    ->searchable()
                    ->preload(),
                
                Forms\Components\Toggle::make('is_main_job')
                    ->label('Основное место работы')
                    ->default(true),
                
                Forms\Components\Select::make('role')
                    ->label('Роль в учреждении')
                    ->options([
                        'attending' => 'Лечащий врач',
                        'consultant' => 'Консультант',
                    ])
                    ->default('attending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('doctor.name') 
                    ->label('Врач')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('facility.name')
                    ->label('Учреждение')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\IconColumn::make('is_main_job')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->label('Основное'),
                
                Tables\Columns\TextColumn::make('role')
                    ->label('Роль')
                    ->formatStateUsing(fn($state) => match($state) {
                        'attending' => 'Лечащий врач',
                        'consultant' => 'Консультант',
                        default => $state,
                    })
                    ->badge(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y')
                    ->label('Дата назначения')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('doctor')
                    ->relationship('doctor', 'name') // Изменено с last_name
                    ->label('Врач'),
                
                Tables\Filters\SelectFilter::make('facility')
                    ->relationship('facility', 'name')
                    ->label('Учреждение'),
                
                Tables\Filters\TernaryFilter::make('is_main_job')
                    ->label('Основное место'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDoctorFacilities::route('/'),
            'create' => CreateDoctorFacility::route('/create'),
            'edit' => EditDoctorFacility::route('/{record}/edit'),
        ];
    }
}
