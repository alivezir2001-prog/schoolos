<?php

namespace App\Filament\Resources\Evidence\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EvidenceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('student.first_name')
                ->label('Öğrenci')
                ->formatStateUsing(function ($state, $record) {
                return $record->student->full_name;
                })
                ->searchable(['first_name', 'last_name'])
                ->sortable(),

                TextColumn::make('title')
                    ->label('Kanıt Başlığı')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('observer.name')
                    ->label('Gözlemi Yapan')
                    ->searchable(),

                TextColumn::make('observed_at')
                    ->label('Gözlem Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Düzenle'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Sil'),
                ]),
            ]);
    }
}