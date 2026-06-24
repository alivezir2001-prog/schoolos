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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();
    
            $table->string('first_name');
    
            $table->string('last_name');
    
            $table->string('tc_no', 11)
                ->nullable();
    
            $table->string('branch')
                ->nullable();
    
            $table->string('phone')
                ->nullable();
    
            $table->string('email')
                ->nullable();
    
            $table->foreignId('homeroom_class_id')
                ->nullable()
                ->constrained('school_classes')
                ->nullOnDelete();
    
            $table->boolean('active')
                ->default(true);
    
            $table->timestamps();
        });
    }
};
