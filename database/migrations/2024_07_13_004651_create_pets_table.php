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
            $table->id();
            $table->string('name');
            $table->string('breed');
            $table->string('photo')->nullable();
            $table->char('microchip_number', 10)->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->dateTime('date_of_adoption')->nullable();
            $table->enum('gender', ["male", "female", "harmaphrodite"]);
            $table->enum('status', ["alive", "dead", "neutered"])->default("alive");
            $table->enum('retainership_plan', ["bronze", "silver","gold", "custom","none"])->nullable();
            $table->string('custom_plan_details')->nullable();
            $table->enum('genus', ["canine", "feline", "caprine", "ovine", "equine", "bovine", "pisces", "oryctolagus"]);
            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")->references('id')->on("users")->onDelete('cascade');
            $table->string('file_number')->nullable();
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
