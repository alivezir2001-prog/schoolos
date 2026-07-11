<?php

namespace App\Filament\Resources\Observations;

use App\Core\Authorization\SchoolScope;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Observations\Pages\CreateObservation;
use App\Filament\Resources\Observations\Pages\EditObservation;
use App\Filament\Resources\Observations\Pages\ListObservations;
use App\Filament\Resources\Observations\Schemas\ObservationForm;
use App\Filament\Resources\Observations\Tables\ObservationsTable;
use App\Models\Observation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ObservationResource extends Resource
{
    protected static ?string $model = Observation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'observation';

    public static function form(Schema $schema): Schema
    {
        return ObservationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ObservationsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return SchoolScope::apply(
            parent::getEloquentQuery()
        );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObservations::route('/'),
            'create' => CreateObservation::route('/create'),
            'edit' => EditObservation::route('/{record}/edit'),
        ];
    }
}
