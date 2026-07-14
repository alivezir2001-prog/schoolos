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

                /*
                |--------------------------------------------------------------------------
                | Learner
                |--------------------------------------------------------------------------
                */

                Select::make('student_id')
                    ->label('👤 Öğrenci')
                    ->options(function () {

                        $user = auth()->user();

                        $query = Student::query();

                        if ($user->role?->code !== 'SYS_ADMIN') {
                            $query->where('school_id', $user->school_id);
                        }

                        return $query
                            ->orderBy('last_name')
                            ->orderBy('first_name')
                            ->get()
                            ->mapWithKeys(fn (Student $student) => [
                                $student->id => $student->full_name,
                            ]);
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | Observation
                |--------------------------------------------------------------------------
                */

                Textarea::make('observation')
                    ->label('📝 Bugün ne gözlemlediniz?')
                    ->placeholder(
                        'Örneğin: Bugün grup çalışması sırasında arkadaşlarının fikirlerini dikkatle dinledi ve tartışmaya katkı sağladı.'
                    )
                    ->hint(
                        'Sadece fark ettiğiniz olayı doğal bir dille yazın. Yorum yapmak veya sonuç çıkarmak zorunda değilsiniz.'
                    )
                    ->rows(8)
                    ->required()
                    ->columnSpanFull(),

                /*
                |--------------------------------------------------------------------------
                | Observation Time
                |--------------------------------------------------------------------------
                */

                DateTimePicker::make('observed_at')
                    ->label('📅 Gözlem Zamanı')
                    ->default(now())
                    ->seconds(false)
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | Optional Metadata
                |--------------------------------------------------------------------------
                */

                TextInput::make('location')
                    ->label('📍 Konum (İsteğe Bağlı)')
                    ->placeholder(
                        'Örn: Fen Laboratuvarı, Bahçe, Kütüphane, Okul Çıkışı'
                    ),

                FileUpload::make('attachment_path')
                    ->label('📎 Ek Dosya (İsteğe Bağlı)')
                    ->disk('public')
                    ->directory('observations')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),

            ]);
    }
}