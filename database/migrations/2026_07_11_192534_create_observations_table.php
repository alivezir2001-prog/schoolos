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

        $table->foreignId('school_id')->constrained()->cascadeOnDelete();

        $table->foreignId('student_id')->constrained()->cascadeOnDelete();

        $table->foreignId('observer_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->text('observation');

        $table->string('location')->nullable();

        $table->string('attachment_path')->nullable();

        $table->timestamp('observed_at');

        $table->timestamps();
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
