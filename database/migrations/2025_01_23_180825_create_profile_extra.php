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
        Schema::table('users', function (Blueprint $table) {
            $table->string('hobbies')->nullable();
            $table->enum('pets', ['yes', 'no'])->default('no');
            $table->enum('kinderen', ['yes', 'no'])->default('no');
            $table->enum('kinderwens', ['yes', 'no'])->default('no');
            $table->string('music_styles')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('hobbies');
            $table->dropColumn('pets');
            $table->dropColumn('music_styles');
            $table->dropColumn('kinderen');
            $table->dropColumn('kinderwens');
        });
    }
};