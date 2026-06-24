<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->nullable()
                ->constrained('school_classes')
                ->nullOnDelete();

            $table->string('tc_no', 11)->nullable();
            $table->string('school_no')->nullable();

            $table->string('first_name');
            $table->string('last_name');

            $table->enum('gender', ['E', 'K'])->nullable();

            $table->date('birth_date')->nullable();

            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->index(['school_id', 'school_class_id']);
            $table->index('school_no');
            $table->index('tc_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
