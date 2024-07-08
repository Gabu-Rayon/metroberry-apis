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
        Schema::create('vehicle_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_avatar')->nullable();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('insurance_company');
            $table->string('insurance_policy_no');
            $table->date('insurance_date_of_issue');
            $table->date('insurance_date_of_expiry');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_insurances');
    }
};
