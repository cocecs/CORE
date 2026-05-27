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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('idno')->unique();
            $table->string('email',50)->unique();
            $table->string('company_name',50);
            $table->string('province', 20)->nullable();
            $table->string('town', 20)->nullable();
            $table->string('brgy', 20)->nullable();
            $table->string('address_details', 50)->nullable();
            $table->string('tel', 15)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('representative_name',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('designation',50)->nullable();
            $table->string('tin',15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
