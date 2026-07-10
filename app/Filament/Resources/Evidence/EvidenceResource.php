<?php

namespace App\Filament\Resources\Evidence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\Evidence\Pages\CreateEvidence;
use App\Filament\Resources\Evidence\Pages\EditEvidence;
use App\Filament\Resources\Evidence\Pages\ListEvidence;
use App\Filament\Resources\Evidence\Schemas\EvidenceForm;
use App\Filament\Resources\Evidence\Tables\EvidenceTable;
use App\Models\Evidence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EvidenceResource extends Resource
{
    protected static ?string $model = Evidence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Kanıtlar';

    protected static ?string $modelLabel = 'Kanıt';

    protected static ?string $pluralModelLabel = 'Kanıtlar';

    protected static string|\UnitEnum|null $navigationGroup = '📈 Gelişim';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return EvidenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EvidenceTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
    $query = parent::getEloquentQuery();

    $user = Auth::user();

    if (! $user) {
        return $query;
    }

    if ($user->role?->code === 'SYS_ADMIN') {
        return $query;
    }

    return $query->where('school_id', $user->school_id);
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvidence::route('/'),
            'create' => CreateEvidence::route('/create'),
            'edit' => EditEvidence::route('/{record}/edit'),
        ];
    }
}
