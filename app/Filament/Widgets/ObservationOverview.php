<?php

namespace App\Filament\Widgets;

use App\Models\Observation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class ObservationOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        $query = Observation::query();

        // SYS_ADMIN tüm sistemi görür
        if ($user->role?->code !== 'SYS_ADMIN') {
            $query->where('school_id', $user->school_id);

            // Öğretmen sadece kendi gözlemlerini görür
            if ($user->role?->code !== 'PRINCIPAL') {
                $query->where('observer_id', $user->id);
            }
        }

        $today = (clone $query)
            ->whereDate('observed_at', today())
            ->count();

        $week = (clone $query)
            ->whereBetween('observed_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])
            ->count();

        $students = (clone $query)
            ->distinct('student_id')
            ->count('student_id');

        return [

            Stat::make('Bugünkü Gözlemler', $today)
                ->description('Bugün kaydedilen gözlemler')
                ->icon('heroicon-o-eye'),

            Stat::make('Bu Hafta', $week)
                ->description('Bu hafta kaydedilen gözlemler')
                ->icon('heroicon-o-calendar'),

            Stat::make('Gözlem Yapılan Öğrenci', $students)
                ->description('Farklı öğrenci sayısı')
                ->icon('heroicon-o-user-group'),

        ];
    }
}