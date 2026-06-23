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
        Schema::create('towns', function (Blueprint $table) {
            $table->id(); // Primary key (town_id)
            $table->string('town');     // e.g., Tangub City, Oroquieta City
            $table->string('province'); // e.g., Misamis Occidental
            $table->timestamps();

            // Prevent duplicate town entries within the same province
            $table->unique(['town', 'province']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('towns');
    }
};
