<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use App\Core\Academic\AcademicYearStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;

class AcademicYearForm
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
                TextInput::make('name')
                    ->required(),
                DatePicker::make('starts_at')
                    ->required(),
                DatePicker::make('ends_at')
                    ->required(),
                Select::make('status')
                    ->label('Durum')
                    ->options([
                        AcademicYearStatus::PLANNING->value => 'Planlanıyor',
                        AcademicYearStatus::ACTIVE->value => 'Aktif',
                        AcademicYearStatus::COMPLETED->value => 'Tamamlandı',
                        AcademicYearStatus::ARCHIVED->value => 'Arşiv',
                    ])
                    ->default(AcademicYearStatus::PLANNING->value)
                    ->required(),
            ]);
    }
}
