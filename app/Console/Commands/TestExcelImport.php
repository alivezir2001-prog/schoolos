<?php

namespace App\Console\Commands;

use App\Services\EOkulStudentImporter;
use Illuminate\Console\Command;

class TestExcelImport extends Command
{
    protected $signature = 'app:test-excel-import {file}';

    protected $description = 'e-Okul XLS test';

    public function handle()
    {
        $file = $this->argument('file');

        if (! file_exists($file)) {
            $this->error("Dosya bulunamadı: {$file}");
            return self::FAILURE;
        }

        $result = (new EOkulStudentImporter())->analyze($file);

        $this->info('Sınıf:');
        $this->line($result['class'] ?? '-');

        $this->newLine();

        $this->info('Öğrenci Sayısı:');
        $this->line((string) $result['student_count']);

        return self::SUCCESS;
    }
}
