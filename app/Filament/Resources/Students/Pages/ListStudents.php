<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    public function getTabs(): array
    {
        return [
            'active' => Tab::make('Aktif')
                ->badge(Student::where('active', true)->count())
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where('active', true)
                ),

            'inactive' => Tab::make('Pasif')
                ->badge(Student::where('active', false)->count())
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where('active', false)
                ),

            'all' => Tab::make('Tümü')
                ->badge(Student::count()),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('import')
                ->label('e-Okuldan Aktar')
                ->icon('heroicon-o-arrow-up-tray')
                ->url('/admin/student-import'),
        ];
    }
}
