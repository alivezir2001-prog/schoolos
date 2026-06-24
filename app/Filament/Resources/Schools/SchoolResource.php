<?php

namespace App\Filament\Resources\Schools;

use App\Filament\Resources\Schools\Pages\CreateSchool;
use App\Filament\Resources\Schools\Pages\EditSchool;
use App\Filament\Resources\Schools\Pages\ListSchools;
use App\Filament\Resources\Schools\Schemas\SchoolForm;
use App\Filament\Resources\Schools\Tables\SchoolsTable;
use App\Models\School;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SchoolResource extends Resource
{
	protected static string|\UnitEnum|null $navigationGroup = '🏫 Yönetim';
    protected static ?string $model = School::class;
    protected static ?string $navigationLabel = 'Okullar';
    protected static ?string $pluralModelLabel = 'Okullar';
    protected static ?string $modelLabel = 'Okul';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SchoolForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        if (!$user) {
            return $query;
        }

        if ($user->role?->code === 'SYS_ADMIN') {
            return $query;
        }

        return $query->where('id', $user->school_id);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchools::route('/'),
            'create' => CreateSchool::route('/create'),
            'edit' => EditSchool::route('/{record}/edit'),
        ];
    }
}
