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
        Schema::create('work_details', function (Blueprint $table) {
            $table->id();
            $table->string('idno')->unique();
            // professional level: 0=entry_level; 1=junior; 2=mid_level; 3=senior; 4=managerial
            $table->string('professional_level', 1)->nullable();
            // employment status: 1=employed; 0=unemployed
            $table->string('employment_status', 1)->nullable();
            // employment type: 1=wage; 2=self
            $table->string('employment_type', 1)->nullable();
            $table->json('self_employed_spec')->nullable();
            $table->string('others_specify',50)->nullable();
            $table->string('job_history',1)->nullable();
            $table->json('exploring_job')->nullable();
            $table->string('distance_job',1)->nullable();
            $table->string('job_roles',1)->nullable();
            $table->json('job_shift')->nullable();
            $table->json('skills')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('work_details');
    }
};
