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
        Schema::table('observations', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Observation Engine v1
            |--------------------------------------------------------------------------
            |
            | Educational Context intentionally omitted.
            | Context will be introduced in a future Context Engine.
            |
            */

            // Observation time index
            $table->index(
                ['student_id', 'observed_at'],
                'obs_student_date_idx'
            );

            // Observer history
            $table->index(
                ['observer_id', 'observed_at'],
                'obs_observer_date_idx'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('observations', function (Blueprint $table) {

            $table->dropIndex('obs_student_date_idx');

            $table->dropIndex('obs_observer_date_idx');

        });
    }
};
