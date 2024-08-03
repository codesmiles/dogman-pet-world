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
        Schema::create('pets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('breed');
            $table->string('photo')->nullable();
            $table->enum('genus', ["canine", "feline", "caprine", "ovine", "equine", "bovine", "pisces", "oryctolagus"]);
            $table->unsignedInteger('weight')->nullable();
            $table->enum('gender', ["male", "female", "harmaphrodite"]);
            $table->enum('status', ["alive", "dead", "neutered"])->default("alive");
            $table->foreignUuid('user_id')->constrained();
            $table->string('file_number')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->char('microchip_number', 10)->nullable();
            $table->dateTime('date_of_adoption')->nullable();
            $table->enum('retainership_plan', ["bronze", "silver","gold", "custom","none"])->nullable();
            $table->string('custom_plan_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
