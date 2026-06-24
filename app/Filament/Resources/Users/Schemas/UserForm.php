<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use App\Models\School;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
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
                    ->searchable(),

                Select::make('role_id')
                    ->label('Rol')
                    ->options(
                        $user?->role?->code === 'SYS_ADMIN'
                            ? Role::pluck('name', 'id')
                            : Role::where('code', '!=', 'SYS_ADMIN')->pluck('name', 'id')
                    )
                    ->searchable(),

                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required(),

                DateTimePicker::make('email_verified_at'),

                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }
}
