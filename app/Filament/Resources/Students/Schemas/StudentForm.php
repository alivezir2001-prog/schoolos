<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\School;
use App\Models\SchoolClass;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentForm
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
                            : School::where('id', $user?->school_id)->get()->mapWithKeys(fn ($class) => [$class->id => $class->grade . '-' . $class->branch])
                    )
                    ->default($user?->school_id)
                    ->disabled($user?->role?->code !== 'SYS_ADMIN')
                    ->live()
                    ->required(),

                Select::make('school_class_id')
                    ->label('Sınıf')
                    ->options(fn ($get) =>
                        SchoolClass::where('school_id', $get('school_id'))
                            ->orderBy('grade')
                            ->orderBy('branch')
                            ->get()->mapWithKeys(fn ($class) => [$class->id => $class->grade . '-' . $class->branch])
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('school_no')
                    ->label('Okul No'),

                TextInput::make('tc_no')
                    ->label('TC Kimlik No')
                    ->maxLength(11),

                TextInput::make('first_name')
                    ->label('Ad')
                    ->required(),

                TextInput::make('last_name')
                    ->label('Soyad')
                    ->required(),

                Select::make('gender')
                    ->label('Cinsiyet')
                    ->options([
                        'E' => 'Erkek',
                        'K' => 'Kız',
                    ]),

                DatePicker::make('birth_date')
                    ->label('Doğum Tarihi'),

                Toggle::make('active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
