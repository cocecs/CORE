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
            $table->json('skills')->nullable();
            // professional level: 0=entry_level; 1=junior; 2=mid_level; 3=senior; 4=managerial
            $table->string('professional_level', 1)->nullable();
            // employment status: 1=employed; 0=unemployed
            $table->string('employment_status', 1)->nullable();
            // employment type: 1=wage; 2=self
            $table->string('employment_type', 1)->nullable();
            $table->json('self_employed_spec')->nullable();
            $table->string('others_specify',50)->nullable();
            $table->string('job_history',2)->nullable();
            $table->string('specify_country',60)->nullable();
            $table->string('other_specify',60)->nullable();
            $table->string('ofw', 1)->nullable();
            $table->string('ofw_specify_country', 50)->nullable();
            $table->string('latest_specify_country', 100)->nullable();
            $table->string('month_year_return', 15)->nullable();
            $table->string('fourps', 1)->nullable();
            $table->string('fourps_houshold_id', 20)->nullable();
            $table->json('exploring_job')->nullable();
            $table->string('distance_job',1)->nullable();
            $table->string('job_roles',1)->nullable();
            $table->json('job_shift')->nullable();
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
