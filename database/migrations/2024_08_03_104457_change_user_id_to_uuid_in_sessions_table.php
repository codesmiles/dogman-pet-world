<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Check if the foreign key constraint exists before trying to drop it
            $foreignKeys = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_SCHEMA', config('database.connections.mysql.database'))
                ->where('TABLE_NAME', 'sessions')
                ->where('CONSTRAINT_NAME', 'sessions_user_id_foreign')
                ->get();

            if ($foreignKeys->count() > 0) {
                $table->dropForeign(['user_id']);
            }

            // Drop the existing `user_id` column if it exists
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropColumn('user_id');
            }

            // Add the new `user_id` column with UUID type
            $table->uuid('user_id')->nullable();

            // Add the foreign key constraint back if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Check if the foreign key constraint exists before trying to drop it
            $foreignKeys = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_SCHEMA', config('database.connections.mysql.database'))
                ->where('TABLE_NAME', 'sessions')
                ->where('CONSTRAINT_NAME', 'sessions_user_id_foreign')
                ->get();

            if ($foreignKeys->count() > 0) {
                $table->dropForeign(['user_id']);
            }

            // Drop the `user_id` column if it exists
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropColumn('user_id');
            }

            // Add the old `user_id` column with bigint unsigned type
            $table->unsignedBigInteger('user_id')->nullable();

            // Add the foreign key constraint back if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
