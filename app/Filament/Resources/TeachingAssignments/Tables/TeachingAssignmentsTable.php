<?php

namespace App\Filament\Resources\TeachingAssignments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class TeachingAssignmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('academicYear.name')
                    ->label('Akademik Yıl')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('schoolClass.name')
                    ->label('Sınıf')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('lesson.name')
                    ->label('Ders')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('teacher.last_name')
                    ->label('Öğretmen')
                    ->formatStateUsing(fn ($record) => $record->teacher?->full_name)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('weekly_hours')
                    ->label('Saat')
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_homeroom_teacher')
                    ->label('Rehber')
                    ->boolean(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Durum')
                    ->colors([
                        'gray' => 'PLANNING',
                        'success' => 'ACTIVE',
                        'warning' => 'COMPLETED',
                        'danger' => 'CANCELLED',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->date('d.m.Y')
                    ->sortable(),

            ])

            ->filters([

                Tables\Filters\SelectFilter::make('academic_year_id')
                    ->relationship('academicYear', 'name')
                    ->label('Akademik Yıl'),

                Tables\Filters\SelectFilter::make('teacher_id')
                    ->relationship('teacher', 'last_name')
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->first_name} {$record->last_name}"
                    )
                    ->label('Öğretmen'),

                Tables\Filters\SelectFilter::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->label('Sınıf'),

            ])

            ->defaultSort('created_at', 'desc')

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