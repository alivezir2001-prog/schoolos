<?php

namespace App\Filament\Resources\TeachingAssignments\Schemas;

use App\Core\Academic\TeachingAssignmentStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeachingAssignmentForm
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

                Select::make('academic_year_id')
                    ->relationship('academicYear', 'name')
                    ->label('Akademik Yıl')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('school_class_id')
                    ->relationship('schoolClass', 'name')
                    ->label('Sınıf')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('lesson_id')
                    ->relationship('lesson', 'name')
                    ->label('Ders')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('teacher_id')
                ->relationship(
                name: 'teacher',
                titleAttribute: 'last_name'
                )
                ->getOptionLabelFromRecordUsing(
                fn ($record) => "{$record->first_name} {$record->last_name}"
                )
                ->label('Öğretmen')
                ->searchable()
                ->preload()
                ->required(),

                TextInput::make('weekly_hours')
                    ->label('Haftalık Ders Saati')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(40)
                    ->suffix('Saat'),

                Toggle::make('is_homeroom_teacher')
                    ->label('Rehber Öğretmen')
                    ->default(false),

                DatePicker::make('starts_at')
                    ->label('Başlangıç Tarihi'),

                DatePicker::make('ends_at')
                    ->label('Bitiş Tarihi')
                    ->afterOrEqual('starts_at'),

                Select::make('status')
                    ->label('Durum')
                    ->options([
                        TeachingAssignmentStatus::PLANNING->value => 'Planlanıyor',
                        TeachingAssignmentStatus::ACTIVE->value => 'Aktif',
                        TeachingAssignmentStatus::COMPLETED->value => 'Tamamlandı',
                        TeachingAssignmentStatus::CANCELLED->value => 'İptal Edildi',
                    ])
                    ->default(TeachingAssignmentStatus::PLANNING->value)
                    ->required(),

                Textarea::make('notes')
                    ->label('Notlar')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
