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
        Schema::create('pet_activity_schedule', function (Blueprint $table) {
            $table->id();
            $table->dateTime("next_visit_date")->nullable();
            $table->unsignedBigInteger("pet_id");
            $table->foreign("pet_id")->references('id')->on("pets")->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("employee_id");
            $table->foreign("employee_id")->references('id')->on("employees")->onDelete('cascade')->onUpdate('cascade');
            $table->string("treatment_or_vaccinations");
            $table->timestamps(); // will work as the current date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_activity_schedule');
    }
};
