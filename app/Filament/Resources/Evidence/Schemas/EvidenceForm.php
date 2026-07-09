<?php

namespace App\Filament\Resources\Evidence\Schemas;

use App\Models\Student;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class EvidenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Hidden::make('school_id')
                    ->default(fn () => Auth::user()?->school_id),

                Hidden::make('observer_id')
                    ->default(fn () => Auth::id()),

                Select::make('student_id')
                    ->label('Öğrenci')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'first_name',
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (Student $record): string => $record->full_name
                    )
                    ->searchable(['first_name', 'last_name'])
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->label('Kanıt Başlığı')
                    ->placeholder('Örn: Fen Laboratuvarı Çalışması')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Kanıt Açıklaması')
                    ->helperText('Lütfen yorum değil, gözlemlediğiniz olayı yazınız.')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                DateTimePicker::make('observed_at')
                    ->label('Gözlem Tarihi')
                    ->default(now())
                    ->required(),

            ]);
    }
}
