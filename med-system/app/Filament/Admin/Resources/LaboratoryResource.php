<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LaboratoryResource\Pages\CreateLaboratory;
use App\Filament\Admin\Resources\LaboratoryResource\Pages\EditLaboratory;
use App\Filament\Admin\Resources\LaboratoryResource\Pages\ListLaboratories;
use App\Models\Laboratory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaboratoryResource extends Resource
{
    protected static ?string $model = Laboratory::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Лаборатории';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Лаборатории';

    protected static ?string $modelLabel = 'Лаборатория';

    protected static ?string $pluralModelLabel = 'Лаборатории';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название лаборатории')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Биохимическая лаборатория №1'),
                
                Forms\Components\Select::make('profile')
                    ->label('Профиль')
                    ->options([
                        'biochemical' => 'Биохимический',
                        'physiological' => 'Физиологический',
                        'chemical' => 'Химический',
                    ])
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('profile')
                    ->label('Профиль')
                    ->formatStateUsing(fn($state) => match($state) {
                        'biochemical' => 'Биохимический',
                        'physiological' => 'Физиологический',
                        'chemical' => 'Химический',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn($state) => match($state) {
                        'biochemical' => 'success',
                        'physiological' => 'info',
                        'chemical' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                
             
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->label('Создана')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('profile')
                    ->options([
                        'biochemical' => 'Биохимический',
                        'physiological' => 'Физиологический',
                        'chemical' => 'Химический',
                    ])
                    ->label('Профиль'),
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
            'index' => ListLaboratories::route('/'),
            'create' => CreateLaboratory::route('/create'),
            'edit' => EditLaboratory::route('/{record}/edit'),
        ];
    }
}
