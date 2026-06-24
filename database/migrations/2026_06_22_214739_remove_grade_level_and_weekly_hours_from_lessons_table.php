<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn([
                'grade_level',
                'weekly_hours',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedTinyInteger('grade_level')->nullable();
            $table->unsignedTinyInteger('weekly_hours')->default(0);
        });
    }
};
