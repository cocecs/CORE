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
        Schema::create('educational_details', function (Blueprint $table) {
            $table->id();
            $table->string('idno'); // Foreign identifier to user
            $table->string('educ_level'); // e.g., 'bachelor', 'vocational', 'associate', 'master'
            $table->string('school');
            $table->string('course_name');
            $table->year('year_graduated');
            $table->text('skills')->nullable(); // Saved skills array as comma-separated or text
            $table->timestamps();

            // Indexing idno for faster search queries
            $table->index('idno');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educational_details');
    }
};
