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
        Schema::create('pet_activity_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime("next_visit_date")->nullable();
            $table->foreignUuid('pet_id')->constrained();
            $table->foreignUuid('employee_id')->constrained();
            $table->string("treatment_or_vaccinations")->nullable();
            $table->string("report")->nullable();
            $table->timestamps(); // will work as the current date


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_activity_schedules');
    }
};
