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
    Schema::create('evidence', function (Blueprint $table) {
        $table->id();

        $table->foreignId('school_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('student_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('observer_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->string('title');

        $table->text('description');

        $table->dateTime('observed_at');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
