<?php

namespace App\Services;

use App\Models\SchoolClass;
use App\Models\Student;
use Smalot\PdfParser\Parser;

class EOkulPdfImporter
{
    public function analyze(int $schoolId, string $filePath): array
    {
        $parser = new Parser();

        $pdf = $parser->parseFile($filePath);

        $pages = $pdf->getPages();

        $classCount = 0;
        $studentCount = 0;

        // Önce bu okuldaki tüm öğrencileri pasif yap
        Student::where('school_id', $schoolId)
            ->update([
                'active' => false,
            ]);

        foreach ($pages as $page) {

            $text = $page->getText();

            $className = null;
            $grade = 0;
            $branch = null;

            if (
                preg_match(
                    '/Ana Sınıfı\s*\/\s*([A-Z])/u',
                    $text,
                    $m
                )
            ) {
                $className = 'ANA-' . $m[1];
                $grade = 0;
                $branch = $m[1];
            } elseif (
                preg_match(
                    '/([5-8])\.\s*Sınıf\s*\/\s*([A-Z])/u',
                    $text,
                    $m
                )
            ) {
                $grade = (int) $m[1];
                $branch = $m[2];
                $className = $grade . '-' . $branch;
            }

            if (! $className) {
                continue;
            }

            $schoolClass = SchoolClass::firstOrCreate(
                [
                    'school_id' => $schoolId,
                    'name' => $className,
                ],
                [
                    'grade' => $grade,
                    'branch' => $branch,
                    'active' => true,
                ]
            );

            $classCount++;

            $lines = preg_split('/\r\n|\r|\n/', $text);

            foreach ($lines as $line) {

                $line = trim($line);

                if (
                    ! preg_match(
                        '/^(\d+)\s+(.+?)\s+(Kız|Erkek)(.+?)\s+(\d+)$/u',
                        $line,
                        $m
                    )
                ) {
                    continue;
                }

                Student::updateOrCreate(
                    [
                        'school_id' => $schoolId,
                        'school_no' => $m[1],
                    ],
                    [
                        'school_class_id' => $schoolClass->id,
                        'first_name' => trim($m[2]),
                        'last_name' => trim($m[4]),
                        'gender' => $m[3] === 'Kız' ? 'K' : 'E',
                        'active' => true,
                    ]
                );

                $studentCount++;
            }
        }

        return [
            'classes_processed' => $classCount,
            'students_processed' => $studentCount,
        ];
    }
}
