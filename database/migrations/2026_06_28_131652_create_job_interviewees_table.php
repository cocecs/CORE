<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_interviewees', function (Blueprint $table) {
            $table->id();

            // References the user's idno string
            $table->string('user_id');
            $table->foreign('user_id')->references('idno')->on('users')->onDelete('cascade');

            // References the custom job_id string
            $table->string('job_id');
            $table->foreign('job_id')->references('job_id')->on('job_postings')->onDelete('cascade');

            // Column status: defaults to interviewee, can be updated to 'hired'
            $table->string('status', 12)->default('interviewee');
            $table->timestamps();

            // Prevents adding the exact same applicant twice to the same job shortlist
            $table->unique(['user_id', 'job_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_interviewees');
    }
};
