<?php

namespace App\Filament\Resources\TeachingAssignments;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeachingAssignments\Pages\CreateTeachingAssignment;
use App\Filament\Resources\TeachingAssignments\Pages\EditTeachingAssignment;
use App\Filament\Resources\TeachingAssignments\Pages\ListTeachingAssignments;
use App\Filament\Resources\TeachingAssignments\Schemas\TeachingAssignmentForm;
use App\Filament\Resources\TeachingAssignments\Tables\TeachingAssignmentsTable;
use App\Models\TeachingAssignment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TeachingAssignmentResource extends Resource
{
    protected static ?string $model = TeachingAssignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = '🎓 Akademik';

    protected static ?string $navigationLabel = 'Öğretmen Görevlendirmeleri';

    protected static ?int $navigationSort = 40;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return TeachingAssignmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeachingAssignmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->role_id == 2) {
            return $query;
        }

        return $query->where(
            'school_id',
            auth()->user()->school_id
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeachingAssignments::route('/'),
            'create' => CreateTeachingAssignment::route('/create'),
            'edit' => EditTeachingAssignment::route('/{record}/edit'),
        ];
    }
}