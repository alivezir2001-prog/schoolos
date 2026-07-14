<?php

namespace App\Filament\Resources\Observations\Pages;

use App\Filament\Resources\Observations\ObservationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditObservation extends EditRecord
{
    protected static string $resource = ObservationResource::class;

    protected static ?string $title = 'Gözlemi Düzenle';

    protected static ?string $breadcrumb = 'Düzenle';

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Gözlem başarıyla güncellendi.';
    }

    protected function getHeaderActions(): array
    {
        return [

            DeleteAction::make()
                ->label('Sil')
                ->visible(
                    fn () => auth()->user()->role?->code === 'SYS_ADMIN'
                ),

        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}