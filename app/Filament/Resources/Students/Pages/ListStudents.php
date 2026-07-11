<?php

namespace App\Filament\Resources\Students\Pages;

use App\Core\Authorization\SchoolScope;
use App\Filament\Resources\Students\StudentResource;
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
                ->modifyQueryUsing(
                    fn (Builder $query) => SchoolScope::apply(
                        $query->where('active', true)
                    )
                ),

            'inactive' => Tab::make('Pasif')
                ->modifyQueryUsing(
                    fn (Builder $query) => SchoolScope::apply(
                        $query->where('active', false)
                    )
                ),

            'all' => Tab::make('Tümü')
                ->modifyQueryUsing(
                    fn (Builder $query) => SchoolScope::apply($query)
                ),

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