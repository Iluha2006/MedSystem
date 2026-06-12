<?php

namespace App\Filament\Admin\Resources\Facilities;

use App\Filament\Admin\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Admin\Resources\Facilities\Pages\EditFacility;
use App\Filament\Admin\Resources\Facilities\Pages\ListFacilities;
use App\Filament\Admin\Resources\Facilities\Pages\ViewFacility;
use App\Models\Facility;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
  
    
    protected static ?string $modelLabel = 'Больницы';
    
protected static ?string $navigationGroup = 'Организации';
protected static ?string $navigationLabel = 'Учреждения';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название'),
                \Filament\Forms\Components\Select::make('type')
                    ->options([
                        'hospital' => 'Больница',
                        'polyclinic' => 'Поликлиника',
                    ])
                    ->required()
                    ->label('Тип'),
                \Filament\Forms\Components\Select::make('parent_hospital_id')
                    ->relationship('parentHospital', 'name')
                    ->label('Головная больница')
                    ->searchable()
                    ->preload(),
                \Filament\Forms\Components\Textarea::make('address')
                    ->maxLength(65535)
                    ->label('Адрес')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Название'),
                \Filament\Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn ($state) => $state === 'hospital' ? 'Больница' : 'Поликлиника')
                    ->label('Тип'),
                \Filament\Tables\Columns\TextColumn::make('parentHospital.name')
                    ->label('Головная больница'),
                \Filament\Tables\Columns\TextColumn::make('address')
                    ->limit(50)
                    ->label('Адрес'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'hospital' => 'Больница',
                        'polyclinic' => 'Поликлиника',
                    ])
                    ->label('Тип'),
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

      
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFacilities::route('/'),
            'create' => CreateFacility::route('/create'),
            'view' => ViewFacility::route('/{record}'),
            'edit' => EditFacility::route('/{record}/edit'),
        ];
    }
}