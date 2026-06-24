<?php

namespace App\Filament\Resources\Teachers;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Teachers\Pages\CreateTeacher;
use App\Filament\Resources\Teachers\Pages\EditTeacher;
use App\Filament\Resources\Teachers\Pages\ListTeachers;
use App\Filament\Resources\Teachers\Schemas\TeacherForm;
use App\Filament\Resources\Teachers\Tables\TeachersTable;
use App\Models\Teacher;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TeacherResource extends Resource
{

	protected static string|\UnitEnum|null $navigationGroup = '🎓 Akademik';
	
	protected static ?string $navigationLabel = 'Öğretmenler';
    protected static ?string $model = Teacher::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Schema $schema): Schema
    {
        return TeacherForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeachersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
            'index' => ListTeachers::route('/'),
            'create' => CreateTeacher::route('/create'),
            'edit' => EditTeacher::route('/{record}/edit'),
        ];
    }
}
