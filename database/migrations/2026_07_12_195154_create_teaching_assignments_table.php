<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teaching_assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('academic_year_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('lesson_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('weekly_hours')->nullable();

            $table->boolean('is_homeroom_teacher')
                ->default(false);

            $table->date('starts_at')->nullable();

            $table->date('ends_at')->nullable();

            $table->string('status', 20)
                ->default('PLANNING');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(
            [
            'academic_year_id',
            'teacher_id',
            'school_class_id',
            'lesson_id',
            ],
            'ta_unique'
            );

            $table->index(
            [
            'school_id',
            'status',
            ],
            'ta_status_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teaching_assignments');
    }
};