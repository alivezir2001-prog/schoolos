<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('school_code')
                    ->default(null),

                Select::make('school_type')
                    ->label('Okul Türü')
                    ->options([
                        'PRIMARY' => 'İlkokul',
                        'MIDDLE' => 'Ortaokul',
                        'HIGH' => 'Lise',
                    ])
                    ->required(),

                TextInput::make('province')
                    ->default(null),

                TextInput::make('district')
                    ->default(null),

                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->tel()
                    ->default(null),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->default(null),

                Toggle::make('active')
                    ->default(true),
            ]);
    }
}
