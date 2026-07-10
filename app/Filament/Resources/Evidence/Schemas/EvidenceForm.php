<?php

namespace App\Filament\Resources\Evidence\Schemas;

use App\Models\Student;
use Filament\Forms\Components\FileUpload;
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
                ->options(function () {

                $user = auth()->user();

                $query = Student::query();

                if ($user->role->code !== 'SYS_ADMIN') {
                $query->where('school_id', $user->school_id);
                }

                return $query
                ->orderBy('first_name')
                ->get()
                ->mapWithKeys(fn (Student $student) => [
                $student->id => $student->first_name . ' ' . $student->last_name,
                ]);

    })
                ->searchable()
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

                FileUpload::make('attachment_path')
                    ->label('Ek Dosya')
                    ->image()
                    ->disk('public')
                    ->directory('evidence')
                    ->visibility('public')
                    ->downloadable()
                    ->openable(),

                DateTimePicker::make('observed_at')
                    ->label('Gözlem Tarihi')
                    ->default(now())
                    ->required(),

            ]);
    }
}
