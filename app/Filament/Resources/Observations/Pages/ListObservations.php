<?php

namespace App\Filament\Resources\Observations\Pages;

use App\Filament\Resources\Observations\ObservationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListObservations extends ListRecords
{
    protected static string $resource = ObservationResource::class;

    protected static ?string $title = 'Gözlemler';

    protected static ?string $breadcrumb = 'Gözlemler';

    protected function getHeaderActions(): array
    {
        return [

            CreateAction::make()
                ->label('Yeni Gözlem'),

        ];
    }
}