<?php

namespace App\Filament\Pages;

use App\Models\School;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class StudentImport extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Öğrenci Aktar';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowUpTray;

    protected string $view = 'filament.pages.student-import';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Select::make('school_id')
                    ->label('Okul')
                    ->options(School::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),

                FileUpload::make('file')
                    ->label('e-Okul PDF Dosyası')
                    ->directory('imports')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->required(),
            ]);
    }

    public function analyze(): void
    {
        $state = $this->form->getState();

        $result = (new \App\Services\EOkulPdfImporter())
            ->analyze(
                (int) $state['school_id'],
                storage_path('app/private/' . $state['file'])
            );

        Notification::make()
            ->title('İçe aktarma tamamlandı')
            ->body(
                $result['classes_processed'] .
                ' sınıf, ' .
                $result['students_processed'] .
                ' öğrenci işlendi.'
            )
            ->success()
            ->send();
    }
}
