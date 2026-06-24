<?php

namespace App\Filament\Resources\ClassSchedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ClassScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
           ->components([
            
                Select::make('school_id')
                    ->label('Okul')
                    ->relationship('school', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->visible(fn () => auth()->user()->role_id == 2),
            
                Hidden::make('school_id')
                    ->default(fn () => auth()->user()->school_id)
                    ->dehydrated()
                    ->visible(fn () => auth()->user()->role_id != 2),
            
                Select::make('class_id')
                    ->label('Sınıf')
                    ->relationship('schoolClass', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            
                Select::make('lesson_id')
                    ->label('Ders')
                    ->relationship('lesson', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            
                Select::make('teacher_id')
                    ->label('Öğretmen')
                    ->relationship('teacher', 'last_name')
                    ->searchable()
                    ->preload()
                    ->required(),
            
                Select::make('day_of_week')
                    ->label('Gün')
                    ->options([
                        1 => 'Pazartesi',
                        2 => 'Salı',
                        3 => 'Çarşamba',
                        4 => 'Perşembe',
                        5 => 'Cuma',
                    ])
                    ->required(),
            
                Select::make('period')
                    ->label('Ders Saati')
                    ->options([
                        1 => '1. Ders',
                        2 => '2. Ders',
                        3 => '3. Ders',
                        4 => '4. Ders',
                        5 => '5. Ders',
                        6 => '6. Ders',
                        7 => '7. Ders',
                        8 => '8. Ders',
                    ])
                    ->required(),
            
            ]);
    }
}
