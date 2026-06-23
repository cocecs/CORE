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
        Schema::create('barangays', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign Key linking this barangay to its parent town
            // constrained() automatically sets up the relationship, and onDelete('cascade')
            // ensures that if a town is deleted, its barangays are cleaned up too.
            $table->foreignId('town_id')->constrained('towns')->onDelete('cascade');

            $table->string('barangay'); // e.g., Maloro

            // Coordinates tracked specifically at the barangay level
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamps();

            // Speed up search performance when filtering by barangay name
            $table->index('barangay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};
