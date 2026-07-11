<?php

namespace App\Filament\Resources\Observations\Schemas;

use App\Models\Student;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ObservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('student_id')
                    ->label('Öğrenci')
                    ->options(function () {

                        $user = auth()->user();

                        $query = Student::query();

                        if ($user->role?->code !== 'SYS_ADMIN') {
                            $query->where('school_id', $user->school_id);
                        }

                        return $query
                            ->orderBy('first_name')
                            ->get()
                            ->mapWithKeys(fn (Student $student) => [
                                $student->id => $student->full_name,
                            ]);

                    })
                    ->searchable()
                    ->required(),

                TextInput::make('location')
                    ->label('Yer')
                    ->placeholder('Örn: Fen Laboratuvarı, Bahçe, 7/A Sınıfı'),

                DateTimePicker::make('observed_at')
                    ->label('Gözlem Tarihi')
                    ->default(now())
                    ->required(),

                Textarea::make('observation')
                    ->label('Bugün ne gözlemlediniz?')
                    ->rows(6)
                    ->helperText('Yorum değil, gözlemlediğiniz olayı olduğu gibi yazınız.')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('attachment_path')
                    ->label('Ek Dosya')
                    ->disk('public')
                    ->directory('observations')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),

            ]);
    }
}