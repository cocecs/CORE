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
        Schema::create('job_saves', function (Blueprint $table) {
            // $table->id();
            // // Foreign keys connecting to users and jobs tables
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('job_id')->constrained('job_postings')->onDelete('cascade');

            // // The tracking status column (e.g., 'saved', 'applied')
            // $table->string('status')->default('saved');
            // $table->timestamps();
            // // Prevents a user from bookmarking the exact same job twice in the table
            // $table->unique(['user_id', 'job_id']);



            $table->id();
            // Foreign keys connecting to users and jobs tables
            $table->string('user_id');
            $table->string('job_id');

            // The tracking status column (e.g., 'saved', 'applied')
            $table->string('status')->default('saved');
            $table->timestamps();
            // Prevents a user from bookmarking the exact same job twice in the table
            $table->unique(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_save');
    }
};
