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
            $table->string('educational_level',15)->nullable();
            $table->string('professional_level', 15)->nullable();
            $table->string('job_history',1)->nullable();
            $table->string('exploring_job',1)->nullable();
            $table->string('distance_job',1)->nullable();
            $table->string('job_roles',1)->nullable();
            $table->string('job_shift',1)->nullable();
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
