<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->foreignId('lesson_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('day_of_week');

            $table->unsignedTinyInteger('period');

            $table->timestamps();

            $table->unique([
                'class_id',
                'day_of_week',
                'period'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
