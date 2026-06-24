<?php

namespace App\Filament\Resources\SchoolClasses;

use App\Filament\Resources\SchoolClasses\Pages\CreateSchoolClass;
use App\Filament\Resources\SchoolClasses\Pages\EditSchoolClass;
use App\Filament\Resources\SchoolClasses\Pages\ListSchoolClasses;
use App\Filament\Resources\SchoolClasses\Schemas\SchoolClassForm;
use App\Filament\Resources\SchoolClasses\Tables\SchoolClassesTable;
use App\Models\SchoolClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SchoolClassResource extends Resource
{
	protected static string|\UnitEnum|null $navigationGroup = '🎓 Akademik';
    protected static ?string $model = SchoolClass::class;
    protected static ?string $navigationLabel = 'Sınıflar';
    protected static ?string $pluralModelLabel = 'Sınıflar';
    protected static ?string $modelLabel = 'Sınıf';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SchoolClassForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchoolClassesTable::configure($table);
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

        return $query->where('school_id', $user->school_id);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchoolClasses::route('/'),
            'create' => CreateSchoolClass::route('/create'),
            'edit' => EditSchoolClass::route('/{record}/edit'),
        ];
    }
}
