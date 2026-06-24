<?php

namespace App\Filament\Resources\Students\Tables;

use App\Models\School;
use App\Models\SchoolClass;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('last_name')

            ->columns([
                TextColumn::make('school.name')
                    ->label('Okul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('schoolClass.name')
                    ->label('Sınıf')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school_no')
                    ->label('Okul No')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('first_name')
                    ->label('Ad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('last_name')
                    ->label('Soyad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('gender')
                    ->label('Cinsiyet')
                    ->formatStateUsing(fn (?string $state) => match ($state) {
                        'E' => 'Erkek',
                        'K' => 'Kız',
                        default => '-',
                    })
                    ->sortable(),

                IconColumn::make('active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('school_id')
                    ->label('Okul')
                    ->options(
                        School::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->toArray()
                    ),

                SelectFilter::make('school_class_id')
                    ->label('Sınıf')
                    ->options(
                        SchoolClass::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->toArray()
                    ),

                SelectFilter::make('gender')
                    ->label('Cinsiyet')
                    ->options([
                        'E' => 'Erkek',
                        'K' => 'Kız',
                    ]),

              
            ])
			->filtersFormColumns(3)
            ->filtersLayout(FiltersLayout::AboveContent)  

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
