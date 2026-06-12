<?php

namespace App\Filament\Admin\Resources\Patients;

use App\Filament\Admin\Resources\Patients\Pages\CreatePatient;
use App\Filament\Admin\Resources\Patients\Pages\EditPatient;
use App\Filament\Admin\Resources\Patients\Pages\ListPatients;
use App\Filament\Admin\Resources\Patients\Pages\ViewPatient;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    
    protected static ?string $navigationIcon = 'heroicon-o-user';
    
    protected static ?string $navigationGroup = 'Пациенты';
    
    protected static ?string $modelLabel = 'Пациент';
    
    protected static ?string $pluralModelLabel = 'Пациенты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('ФИО'),
                \Filament\Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(150)
                    ->label('Возраст'),
                \Filament\Forms\Components\DatePicker::make('birth_date')
                    ->label('Дата рождения'),
                \Filament\Forms\Components\Textarea::make('medical_history')
                    ->label('История болезни')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\TextEntry::make('name')
                    ->label('ФИО'),
                \Filament\Infolists\Components\TextEntry::make('age')
                    ->label('Возраст'),
                \Filament\Infolists\Components\TextEntry::make('birth_date')
                    ->date()
                    ->label('Дата рождения'),
                \Filament\Infolists\Components\TextEntry::make('medical_history')
                    ->limit(50)
                    ->label('История болезни'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('ФИО'),
                \Filament\Tables\Columns\TextColumn::make('age')
                    ->sortable()
                    ->label('Возраст'),
                \Filament\Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable()
                    ->label('Дата рождения'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\ViewAction::make()
                    ->label('')
                    ->tooltip('Просмотр'),
                \Filament\Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Редактировать'),
                \Filament\Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Удалить'),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPatients::route('/'),
            'create' => CreatePatient::route('/create'),
            'view' => ViewPatient::route('/{record}'),
            'edit' => EditPatient::route('/{record}/edit'),
        ];
    }
}