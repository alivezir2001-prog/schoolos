<?php

namespace App\Filament\Widgets;

use App\Models\School;
use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsByGradeChart extends ChartWidget
{
	protected static ?int $sort = 20;
    protected ?string $heading = 'Sınıf Seviyelerine Göre Öğrenci Sayısı';
	protected int|string|array $columnSpan = 'full';
    public function getHeading(): string
    {
        return auth()->user()?->role?->code === 'SYS_ADMIN'
            ? 'Okullara Göre Öğrenci Sayısı'
            : 'Sınıf Seviyelerine Göre Öğrenci Sayısı';
    }

   protected function getData(): array
{
    $user = auth()->user();

    if ($user?->role?->code === 'SYS_ADMIN') {

        $rows = School::query()
            ->leftJoin('students', function ($join) {
                $join->on('schools.id', '=', 'students.school_id')
                    ->where('students.active', true);
            })
            ->select(
                'schools.name',
                DB::raw('count(students.id) as total')
            )
            ->groupBy('schools.id', 'schools.name')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Öğrenci Sayısı',
                    'data' => $rows->pluck('total')->toArray(),
                ],
            ],
            'labels' => $rows->pluck('name')->toArray(),
        ];
    }

    $rows = Student::query()
        ->join('school_classes', 'students.school_class_id', '=', 'school_classes.id')
        ->where('students.active', true)
        ->where('students.school_id', $user->school_id)
        ->select(
            DB::raw('school_classes.grade as grade'),
            DB::raw('count(*) as total')
        )
        ->groupBy('school_classes.grade')
        ->orderBy('school_classes.grade')
        ->get();

    return [
        'datasets' => [
            [
                'label' => 'Öğrenci Sayısı',
                'data' => $rows->pluck('total')->toArray(),
            ],
        ],
        'labels' => $rows
            ->pluck('grade')
            ->map(fn ($grade) => $grade == 0 ? 'Ana Sınıfı' : $grade . '. Sınıf')
            ->toArray(),
    ];
}
    protected function getType(): string
    {
        return 'bar';
    }
}
