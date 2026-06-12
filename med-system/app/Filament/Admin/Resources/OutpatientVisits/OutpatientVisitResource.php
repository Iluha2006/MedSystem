<?php

namespace App\Filament\Admin\Resources\OutpatientVisits;

use App\Filament\Admin\Resources\OutpatientVisits\Pages\CreateOutpatientVisit;
use App\Filament\Admin\Resources\OutpatientVisits\Pages\EditOutpatientVisit;
use App\Filament\Admin\Resources\OutpatientVisits\Pages\ListOutpatientVisits;
use App\Filament\Admin\Resources\OutpatientVisits\Pages\ViewOutpatientVisit;
use App\Models\Cabinet;
use App\Models\Doctor;
use App\Models\OutpatientVisit;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class OutpatientVisitResource extends Resource
{
    protected static ?string $model = OutpatientVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Записи';
    protected static ?string $modelLabel = 'Запись к врачу';
    protected static ?string $pluralModelLabel = 'Записи к врачу';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('patient_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Пациент')
                    ->options(function () {
                        return Patient::with('user')
                            ->get()
                            ->pluck('user.name', 'id')
                            ->filter();
                    }),

                \Filament\Forms\Components\Select::make('doctor_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Врач')
                    ->options(function () {
                        return Doctor::pluck('name', 'id');
                    }),

                \Filament\Forms\Components\Select::make('facility_id')
                    ->relationship('facility', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Учреждение'),

                \Filament\Forms\Components\Select::make('assigned_cabinet_id')
                    ->relationship('assignedCabinet', 'cabinet_number')
                    ->getOptionLabelFromRecordUsing(fn (Cabinet $record) => $record->full_name)
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Кабинет'),

                \Filament\Forms\Components\DateTimePicker::make('visit_date')
                    ->required()
                    ->label('Дата и время приёма'),

                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Запланирован',
                        'confirmed' => 'Подтверждён',
                        'cancelled' => 'Отменён',
                        'completed' => 'Завершён',
                    ])
                    ->required()
                    ->label('Статус'),

                \Filament\Forms\Components\Textarea::make('complaint')
                    ->maxLength(2000)
                    ->nullable()
                    ->label('Жалобы')
                    ->columnSpanFull(),

                \Filament\Forms\Components\Textarea::make('diagnosis')
                    ->maxLength(1000)
                    ->nullable()
                    ->label('Диагноз')
                    ->columnSpanFull(),

                \Filament\Forms\Components\Textarea::make('prescription')
                    ->maxLength(5000)
                    ->nullable()
                    ->label('Назначение')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return OutpatientVisit::query()
                    ->with(['patient.user', 'doctor', 'facility', 'assignedCabinet']);
            })
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('patient.user.name')
                    ->searchable(['patient.name', 'patient.user.name'])
                    ->sortable(query: function ($query, string $direction) {
                        return $query->orderBy(
                            Patient::select('name')
                                ->whereColumn('patients.id', 'outpatient_visits.patient_id'),
                            $direction
                        );
                    })
                    ->getStateUsing(fn ($record) => $record->patient?->user?->name ?? $record->patient?->name)
                    ->label('Пациент'),

                \Filament\Tables\Columns\TextColumn::make('doctor.name')
                    ->searchable()
                    ->sortable()
                    ->label('Врач'),

                \Filament\Tables\Columns\TextColumn::make('visit_date')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->label('Дата'),

                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'scheduled' => 'Запланирован',
                        'confirmed' => 'Подтверждён',
                        'cancelled' => 'Отменён',
                        'completed' => 'Завершён',
                    })
                    ->label('Статус'),

                \Filament\Tables\Columns\TextColumn::make('facility.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Учреждение'),

                \Filament\Tables\Columns\TextColumn::make('assignedCabinet.cabinet_number')
                    ->getStateUsing(fn ($record) => $record->assignedCabinet?->full_name)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Кабинет'),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i')
                    ->label('Создан')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('visit_date', 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'Запланирован',
                        'confirmed' => 'Подтверждён',
                        'cancelled' => 'Отменён',
                        'completed' => 'Завершён',
                    ])
                    ->label('Статус'),

                \Filament\Tables\Filters\SelectFilter::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Врач'),

                \Filament\Tables\Filters\SelectFilter::make('facility_id')
                    ->relationship('facility', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Учреждение'),

                \Filament\Tables\Filters\Filter::make('visit_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('date_from')
                            ->label('Дата с'),
                        \Filament\Forms\Components\DatePicker::make('date_until')
                            ->label('Дата по'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['date_from'], fn($q, $date) => $q->whereDate('visit_date', '>=', $date))
                            ->when($data['date_until'], fn($q, $date) => $q->whereDate('visit_date', '<=', $date));
                    })
                    ->label('Дата приёма'),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\TextEntry::make('patient.user.name')
                    ->label('Пациент')
                    ->getStateUsing(fn ($record) => $record->patient?->user?->name ?? $record->patient?->name),
                \Filament\Infolists\Components\TextEntry::make('doctor.name')
                    ->label('Врач'),
                \Filament\Infolists\Components\TextEntry::make('visit_date')
                    ->dateTime('d.m.Y H:i')
                    ->label('Дата и время приёма'),
                \Filament\Infolists\Components\TextEntry::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'scheduled' => 'Запланирован',
                        'confirmed' => 'Подтверждён',
                        'cancelled' => 'Отменён',
                        'completed' => 'Завершён',
                    })
                    ->label('Статус'),
                \Filament\Infolists\Components\TextEntry::make('facility.name')
                    ->label('Учреждение'),
                \Filament\Infolists\Components\TextEntry::make('assignedCabinet.cabinet_number')
                    ->getStateUsing(fn ($record) => $record->assignedCabinet?->full_name)
                    ->label('Кабинет'),
                \Filament\Infolists\Components\TextEntry::make('complaint')
                    ->label('Жалобы')
                    ->columnSpanFull(),
                \Filament\Infolists\Components\TextEntry::make('diagnosis')
                    ->label('Диагноз')
                    ->columnSpanFull(),
                \Filament\Infolists\Components\TextEntry::make('prescription')
                    ->label('Назначение')
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOutpatientVisits::route('/'),
            'create' => CreateOutpatientVisit::route('/create'),
            'view' => ViewOutpatientVisit::route('/{record}'),
            'edit' => EditOutpatientVisit::route('/{record}/edit'),
        ];
    }
}
