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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('idno')->unique();
            $table->integer('job_id')->unique();
            $table->string('job_type', 1);
            $table->string('job_category', 3);
            $table->json('skills_required');
            $table->string('job_title',50);
            $table->text('job_description');
            $table->text('job_requirements');
            $table->string('place_of_work',100);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('sex_preference',1);
            $table->integer('num_positions');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
