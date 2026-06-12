<?php

namespace App\Filament\Admin\Resources\Doctors;

use App\Filament\Admin\Resources\Doctors\Pages\CreateDoctor;
use App\Filament\Admin\Resources\Doctors\Pages\EditDoctor;
use App\Filament\Admin\Resources\Doctors\Pages\ListDoctors;
use App\Filament\Admin\Resources\Doctors\Pages\ViewDoctor;
use App\Models\Doctor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationGroup = 'Персонал';
    
    protected static ?string $modelLabel = 'Врач';
    
    protected static ?string $pluralModelLabel = 'Врачи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('ФИО'),
                    
                \Filament\Forms\Components\Select::make('specialty_id')
                    ->relationship('specialty', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Специальность'),
                    
                \Filament\Forms\Components\Select::make('degree_id')
                    ->relationship('degree', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Ученая степень'),
                    
                \Filament\Forms\Components\Select::make('academic_title_id')
                    ->relationship('academicTitle', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Ученое звание'),
                    
                \Filament\Forms\Components\TextInput::make('experience_years')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(70)
                    ->default(0)
                    ->label('Стаж (лет)'),
                    
                \Filament\Forms\Components\TextInput::make('hazard_coeff')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(2)
                    ->default(0)
                    ->label('Коэффициент вредности'),
                    
                \Filament\Forms\Components\TextInput::make('surgeries_performed')
                    ->numeric()
                    ->minValue(0)
                    ->nullable()
                    ->label('Проведено операций'),
                    
                \Filament\Forms\Components\TextInput::make('surgeries_fatal')
                    ->numeric()
                    ->minValue(0)
                    ->nullable()
                    ->label('Летальных исходов'),
                    
                \Filament\Forms\Components\TextInput::make('extra_vacation_days')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->label('Дополнительные дни отпуска'),
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
                    
                \Filament\Tables\Columns\TextColumn::make('specialty.name')
                    ->searchable()
                    ->sortable()
                    ->label('Специальность'),
                    
                \Filament\Tables\Columns\TextColumn::make('degree.name')
                    ->label('Ученая степень'),
                    
                \Filament\Tables\Columns\TextColumn::make('academicTitle.name')
                    ->label('Ученое звание'),
                    
                \Filament\Tables\Columns\TextColumn::make('experience_years')
                    ->label('Стаж'),
                    
                \Filament\Tables\Columns\TextColumn::make('hazard_coeff')
                    ->label('Коэф. вредности'),
                    
                \Filament\Tables\Columns\TextColumn::make('surgeries_performed')
                    ->label('Операций')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('specialty_id')
                    ->relationship('specialty', 'name')
                    ->label('Специальность'),
                    
                \Filament\Tables\Filters\Filter::make('experience_years')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('min_years')
                            ->numeric()
                            ->label('Мин. стаж'),
                        \Filament\Forms\Components\TextInput::make('max_years')
                            ->numeric()
                            ->label('Макс. стаж'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['min_years'], fn($q, $min) => $q->where('experience_years', '>=', $min))
                            ->when($data['max_years'], fn($q, $max) => $q->where('experience_years', '<=', $max));
                    })
                    ->label('Стаж'),
            ])
            ->actions([
                \Filament\Tables\Actions\ViewAction::make(),
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListDoctors::route('/'),
            'create' => CreateDoctor::route('/create'),
            'view' => ViewDoctor::route('/{record}'),
            'edit' => EditDoctor::route('/{record}/edit'),
        ];
    }


}