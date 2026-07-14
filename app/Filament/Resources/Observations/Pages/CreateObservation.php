<?php

namespace App\Filament\Resources\Observations\Pages;

use App\Filament\Resources\Observations\ObservationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateObservation extends CreateRecord
{
    protected static string $resource = ObservationResource::class;

    protected static ?string $title = 'Yeni Gözlem';

    protected static ?string $breadcrumb = 'Yeni';

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Teşekkür ederiz. Bu gözlem öğrenciyi daha iyi anlamamıza katkı sağlayacak.';
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        $data['school_id'] = $user->school_id;
        $data['observer_id'] = $user->id;

        return $data;
    }
}