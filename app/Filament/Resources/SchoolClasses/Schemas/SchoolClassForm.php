<?php

namespace App\Filament\Resources\SchoolClasses\Schemas;

use App\Models\School;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolClassForm
{
    public static function configure(Schema $schema): Schema
    {
        $user = auth()->user();

        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Okul')
                    ->options(
                        $user?->role?->code === 'SYS_ADMIN'
                            ? School::pluck('name', 'id')
                            : School::where('id', $user?->school_id)->pluck('name', 'id')
                    )
                    ->default($user?->school_id)
                    ->disabled($user?->role?->code !== 'SYS_ADMIN')
                    ->required()
                    ->searchable(),

                TextInput::make('grade')
                    ->label('Sınıf')
                    ->numeric()
                    ->required()
                    ->live(),

                TextInput::make('branch')
                    ->label('Şube')
                    ->required()
                    ->live(),

                Hidden::make('name')
                    ->dehydrateStateUsing(
                        fn ($state, $get) => $get('grade') . '-' . strtoupper($get('branch'))
                    ),

                Toggle::make('active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
