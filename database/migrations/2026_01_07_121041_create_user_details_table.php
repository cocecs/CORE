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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('idno');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('ext')->nullable();
            $table->date('date_of_birth');
            $table->string('province')->nullable();
            $table->string('town')->nullable();
            $table->string('address')->nullable();
            $table->string('tel_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->text('about_me')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
