<?php

namespace App\Filament\Widgets;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolClass;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentStats extends StatsOverviewWidget
{
	protected static ?int $sort = 10;
   	protected function getStats(): array
    {
        $user = Auth::user();
    
        if ($user?->role?->code === 'SYS_ADMIN') {
    
           return [
                Stat::make(
                    'Toplam Okul',
                    School::count()
                )
                    ->description('Sistemde kayıtlı okullar')
                    ->descriptionIcon('heroicon-m-building-office-2')
                    ->color('primary'),
            
                Stat::make(
                    'Toplam Öğrenci',
                    Student::where('active', true)->count()
                )
                    ->description('Aktif öğrenciler')
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('success'),
            
                Stat::make(
                    'Toplam Sınıf',
                    SchoolClass::where('active', true)->count()
                )
                    ->description('Aktif sınıflar')
                    ->descriptionIcon('heroicon-m-book-open')
                    ->color('warning'),
            
                Stat::make(
                    'Kullanıcı',
                    User::count()
                )
                    ->description('Sisteme kayıtlı kullanıcılar')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('danger'),
            ];
        }
    
        return [
            Stat::make(
                'Öğrenci',
                Student::where('school_id', $user->school_id)
                    ->where('active', true)
                    ->count()
            ),
    
            Stat::make(
                'Sınıf',
                SchoolClass::where('school_id', $user->school_id)
                    ->where('active', true)
                    ->count()
            ),
    
            Stat::make(
                'Kız Öğrenci',
                Student::where('school_id', $user->school_id)
                    ->where('active', true)
                    ->where('gender', 'K')
                    ->count()
            ),
    
            Stat::make(
                'Erkek Öğrenci',
                Student::where('school_id', $user->school_id)
                    ->where('active', true)
                    ->where('gender', 'E')
                    ->count()
            ),
        ];
    }
}
