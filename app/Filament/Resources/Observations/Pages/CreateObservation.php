<?php

namespace App\Filament\Resources\Observations\Pages;

use App\Filament\Resources\Observations\ObservationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateObservation extends CreateRecord
{
    protected static string $resource = ObservationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        $data['school_id'] = $user->school_id;
        $data['observer_id'] = $user->id;

        return $data;
    }
}