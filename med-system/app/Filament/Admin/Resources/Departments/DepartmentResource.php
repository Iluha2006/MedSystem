<?php

namespace App\Filament\Admin\Resources\Departments;

use App\Filament\Admin\Resources\Departments\Pages\CreateDepartment;
use App\Filament\Admin\Resources\Departments\Pages\EditDepartment;
use App\Filament\Admin\Resources\Departments\Pages\ListDepartments;
use App\Filament\Admin\Resources\Departments\Pages\ViewDepartment;
use App\Models\Department;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;
             
     protected static ?string $modelLabel = 'Отдел';
    protected static ?string $pluralModelLabel = 'Отделы';
    protected static ?string $navigationLabel = 'Отделы';
    protected static ?string $navigationGroup = 'Организации';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                \Filament\Forms\Components\Select::make('building_id')
                    ->relationship('building', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Здание'),
                    
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название отдела'),
                    
    
                \Filament\Forms\Components\TextInput::make('specialization')
                    ->required()
                    ->maxLength(255)
                    ->label('Специализация'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('building.name')
                    ->searchable()
                    ->sortable()
                    ->label('Здание'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Название'),
                Tables\Columns\TextColumn::make('specialization')
                    ->searchable()
                    ->label('Специализация'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->tooltip('Просмотр'),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Редактировать'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Удалить')
                    ->requiresConfirmation(),
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
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
          
            'edit' => EditDepartment::route('/{record}/edit'),
        ];
    }
}