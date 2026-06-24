<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;

class EOkulStudentImporter
{
    public function analyze(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);

        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray();

        dd(
            array_slice($rows, 150, 20)
        );
    }
}
