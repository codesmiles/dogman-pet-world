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
        Schema::create('client_pet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->foreign("pet_id")->references('id')->on("pets")->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign("client_id")->references('id')->on("users")->onDelete('cascade');
            $table->unsignedInteger('file_number')->nullable();
            $table->unsignedInteger('dpetworld_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_pet');
    }
};
