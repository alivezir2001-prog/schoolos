<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;


class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
				Select::make('school_id')
				        ->relationship('school', 'name')
				        ->label('Okul')
				        ->searchable()
				        ->preload()
				        ->required()
				        ->visible(fn () => auth()->user()->role_id == 2),

				 Hidden::make('school_id')
				        ->default(fn () => auth()->user()->school_id)
				        ->dehydrated()
				        ->visible(fn () => auth()->user()->role_id != 2),
            
                TextInput::make('first_name')
                    ->label('Ad')
                    ->required(),
            
                TextInput::make('last_name')
                    ->label('Soyad')
                    ->required(),
            
                TextInput::make('tc_no')
                    ->label('TC Kimlik No')
                    ->maxLength(11),
            
                TextInput::make('branch')
                    ->label('Branş'),
            
                TextInput::make('phone')
                    ->label('Telefon')
                    ->tel(),
            
                TextInput::make('email')
                    ->label('E-posta')
                    ->email(),
            
                Toggle::make('active')
                    ->label('Aktif')
                    ->default(true),

                Select::make('lessons')
                        ->label('Verdiği Dersler')
                        ->multiple()
                        ->relationship('lessons', 'name')
                        ->preload()
                        ->searchable(),    
            ]);
    }
}
