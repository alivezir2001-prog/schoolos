<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_years', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            // Example: 2026-2027
            $table->string('name', 20);

            $table->date('starts_at');

            $table->date('ends_at');

            // PLANNING | ACTIVE | COMPLETED | ARCHIVED
            $table->string('status', 20)
                ->default('PLANNING');

            $table->timestamps();

            $table->unique([
                'school_id',
                'name',
            ]);

            $table->index([
                'school_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};