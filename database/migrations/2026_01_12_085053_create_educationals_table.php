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
        Schema::create('educationals', function (Blueprint $table) {
            $table->id();
            $table->string('idno')->unique();
            $table->string('elementary_school')->nullable();
            $table->string('basic_education')->nullable();
            $table->year('elementary_graduated')->nullable();
            $table->string('secondary_school')->nullable();
            $table->string('senior_high_strand')->nullable();
            $table->year('secondary_graduated')->nullable();
            $table->string('vocational_school', 100)->nullable();
            $table->string('vocational_course', 100)->nullable();
            $table->year('vocational_graduated')->nullable();
            $table->json('vocational_skills')->nullable();
            $table->string('tertiary_school', 100)->nullable();
            $table->string('course_degree', 100)->nullable();
            $table->year('tertiary_graduated')->nullable();
            $table->json('bachelor_skills')->nullable();
            $table->string('postgrad_school', 100)->nullable();
            $table->string('postgrad_course_degree', 100)->nullable();
            $table->year('postgrad_graduated')->nullable();
            $table->json('masters_skills')->nullable();
            $table->string('doctoral_school', 100)->nullable();
            $table->string('doctoral_course_degree', 100)->nullable();
            $table->year('doctoral_graduated')->nullable();
            $table->json('doctoral_skills')->nullable();
            $table->string('level_reached')->nullable();
            $table->year('year_last_attended')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educationals');
    }
};
