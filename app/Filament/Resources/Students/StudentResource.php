<?php

namespace App\Filament\Resources\Students;

use App\Core\Authorization\SchoolScope;
use App\Filament\Resources\Students\Pages\CreateStudent;
use App\Filament\Resources\Students\Pages\EditStudent;
use App\Filament\Resources\Students\Pages\ListStudents;
use App\Filament\Resources\Students\Schemas\StudentForm;
use App\Filament\Resources\Students\Tables\StudentsTable;
use App\Models\Student;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class StudentResource extends Resource
{
	protected static string|\UnitEnum|null $navigationGroup = '🎓 Akademik';
    protected static ?string $model = Student::class;
    protected static ?string $navigationLabel = 'Öğrenciler';
    protected static ?string $pluralModelLabel = 'Öğrenciler';
    protected static ?string $modelLabel = 'Öğrenci';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'last_name';

    public static function form(Schema $schema): Schema
    {
        return StudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
{
        return SchoolScope::apply(
        parent::getEloquentQuery()
            ->where('active', true)
    );

}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'edit' => EditStudent::route('/{record}/edit'),
        ];
    }
}
