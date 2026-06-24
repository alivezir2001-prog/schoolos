<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

				TextColumn::make('school.name')
				    ->label('Okul')
				    ->sortable()
				    ->searchable(),
            
                TextColumn::make('first_name')
                    ->label('Ad')
                    ->searchable()
                    ->sortable(),
            
                TextColumn::make('last_name')
                    ->label('Soyad')
                    ->searchable()
                    ->sortable(),
            
                TextColumn::make('branch')
                    ->label('Branş')
                    ->searchable(),
            
                TextColumn::make('phone')
                    ->label('Telefon'),
            
                TextColumn::make('email')
                    ->label('E-posta'),
            
                IconColumn::make('active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
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
