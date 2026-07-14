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
    Schema::create('observations', function (Blueprint $table) {

    $table->id();

    // Multi-school
    $table->foreignId('school_id')
        ->constrained()
        ->cascadeOnDelete();

    // Learner
    $table->foreignId('student_id')
        ->constrained()
        ->cascadeOnDelete();

    // Educational Context
    $table->foreignId('teaching_assignment_id')
        ->constrained()
        ->cascadeOnDelete();

    // Observer
    $table->foreignId('observer_id')
        ->constrained('users')
        ->cascadeOnDelete();

    // Observation text
    $table->text('observation');

    // Optional context
    $table->string('location')->nullable();

    $table->string('attachment_path')->nullable();

    // When it happened
    $table->timestamp('observed_at');

    $table->timestamps();

    // Indexes
    $table->index(
        ['student_id', 'observed_at'],
        'obs_student_date_idx'
    );

    $table->index(
        ['teaching_assignment_id', 'observed_at'],
        'obs_assignment_date_idx'
    );

});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
