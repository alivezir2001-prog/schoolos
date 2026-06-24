<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Models\School;

class LessonForm
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
                TextInput::make('name')
                        ->label('Ders Adı')
                        ->required(),
        
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
