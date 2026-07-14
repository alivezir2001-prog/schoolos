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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    protected static string|\UnitEnum|null $navigationGroup = '🎓 Akademik';

    protected static ?string $navigationLabel = 'Gözlemler';

    protected static ?int $navigationSort = 50;

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
    $query = SchoolScope::apply(
        parent::getEloquentQuery()
    );

    $user = auth()->user();

    // Sistem yöneticisi her şeyi görür.
    if ($user->role?->code === 'SYS_ADMIN') {
        return $query;
    }

    // Müdür kendi okulundaki her şeyi görür.
    if ($user->role?->code === 'PRINCIPAL') {
        return $query;
    }

    // Öğretmen sadece kendi oluşturduğu gözlemleri görür.
    if ($user->role?->code === 'TEACHER') {
        return $query->where(
            'observer_id',
            $user->id
        );
    }

    return $query;
}

    public static function getRelations(): array
    {
        return [];
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


/*
|--------------------------------------------------------------------------
| TODO
|--------------------------------------------------------------------------
|
| Observation Visibility v2
|
| Teachers should be able to view observations
| for learners they currently teach through
| Teaching Assignments.
|
*/