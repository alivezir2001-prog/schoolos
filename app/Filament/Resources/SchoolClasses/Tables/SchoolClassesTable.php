<?php

namespace App\Filament\Resources\SchoolClasses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolClassesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')
                    ->label('Okul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Sınıf')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('grade')
                    ->label('Kademe')
                    ->sortable(),

                TextColumn::make('branch')
                    ->label('Şube')
                    ->sortable(),

                TextColumn::make('students_count')
                    ->counts('students')
                    ->label('Öğrenci')
                    ->sortable(),

                TextColumn::make('girls_count')
                    ->label('Kız')
                    ->state(fn ($record) =>
                        $record->students()
                            ->where('active', true)
                            ->where('gender', 'K')
                            ->count()
                    ),

                TextColumn::make('boys_count')
                    ->label('Erkek')
                    ->state(fn ($record) =>
                        $record->students()
                            ->where('active', true)
                            ->where('gender', 'E')
                            ->count()
                    ),

                IconColumn::make('active')
                    ->label('Aktif')
                    ->boolean(),
            ])

            ->filters([
                //
            ])

          ->recordActions([
                Action::make('students')
                    ->label('Öğrenciler')
                    ->icon('heroicon-o-users')
                    ->url(fn ($record) =>
                        '/admin/students?filters[school_class_id][value]=' . $record->id
                    ),
            
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
