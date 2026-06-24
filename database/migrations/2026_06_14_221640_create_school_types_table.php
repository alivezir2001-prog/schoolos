<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_types', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('name');

            $table->unsignedTinyInteger('min_grade')->nullable();
            $table->unsignedTinyInteger('max_grade')->nullable();

            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_types');
    }
};
