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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('organisation_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('license')->unique()->nullable();
            $table->date('license_expiry')->nullable();
            $table->string('nhif_number')->nullable();
            $table->string('nssf_number')->nullable();
            $table->string('kra_pin')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
