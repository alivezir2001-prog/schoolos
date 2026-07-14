<?php

namespace App\Filament\Resources\Observations\Tables;

use App\Core\Authorization\Authorization;
use App\Models\Observation;
use App\Models\Student;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ObservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('observed_at', 'desc')

            ->columns([

                TextColumn::make('student.full_name')
                    ->label('👤 Öğrenci')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('observation')
                    ->label('📝 Gözlem')
                    ->limit(120)
                    ->tooltip(fn (Observation $record) => $record->observation)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('observed_at')
                    ->label('📅 Gözlem Zamanı')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('observer.name')
                    ->label('👨‍🏫 Gözlemci')
                    ->searchable()
                    ->sortable()
                    ->visible(fn () => Authorization::isPrincipalOrAdmin()),

                TextColumn::make('location')
                    ->label('📍 Konum')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('attachment_path')
                    ->label('📎')
                    ->boolean()
                    ->getStateUsing(
                        fn (Observation $record) => ! empty($record->attachment_path)
                    ),

            ])

            ->filters([

                SelectFilter::make('student_id')
                    ->label('Öğrenci')
                    ->options(function () {

                        $query = Student::query();

                        if (! Authorization::isSysAdmin()) {
                            $query->where(
                                'school_id',
                                Authorization::schoolId()
                            );
                        }

                        return $query
                            ->orderBy('last_name')
                            ->orderBy('first_name')
                            ->get()
                            ->mapWithKeys(fn (Student $student) => [
                                $student->id => $student->full_name,
                            ]);
                    })
                    ->searchable()
                    ->preload(),

                SelectFilter::make('observer_id')
                    ->label('Gözlemci')
                    ->options(function () {

                        $query = User::query();

                        if (! Authorization::isSysAdmin()) {
                            $query->where(
                                'school_id',
                                Authorization::schoolId()
                            );
                        }

                        return $query
                            ->orderBy('name')
                            ->pluck('name', 'id');

                    })
                    ->searchable()
                    ->preload()
                    ->visible(fn () => Authorization::isPrincipalOrAdmin()),

                SelectFilter::make('location')
                    ->label('Konum')
                    ->options(function () {

                        $query = Observation::query();

                        if (! Authorization::isSysAdmin()) {
                            $query->where(
                                'school_id',
                                Authorization::schoolId()
                            );
                        }

                        return $query
                            ->whereNotNull('location')
                            ->distinct()
                            ->orderBy('location')
                            ->pluck('location', 'location');

                    }),

                Filter::make('observed_at')
                    ->label('Tarih')
                    ->form([
                        DatePicker::make('from')
                            ->label('Başlangıç'),

                        DatePicker::make('until')
                            ->label('Bitiş'),
                    ])
                    ->query(function ($query, array $data) {

                        return $query
                            ->when(
                                $data['from'],
                                fn ($q) => $q->whereDate(
                                    'observed_at',
                                    '>=',
                                    $data['from']
                                )
                            )
                            ->when(
                                $data['until'],
                                fn ($q) => $q->whereDate(
                                    'observed_at',
                                    '<=',
                                    $data['until']
                                )
                            );

                    }),

            ])

            ->filtersLayout(FiltersLayout::AboveContent)

            ->filtersFormColumns(2)

            ->recordActions([

                EditAction::make(),

                // ViewAction ileride eklenecek.
                // Observation geçmişi düzenlemekten çok okumaya yöneliktir.

            ])

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make()
                        ->visible(
                            fn () => auth()->user()->role?->code === 'SYS_ADMIN'
                        ),

                ]),

            ]);
    }
}