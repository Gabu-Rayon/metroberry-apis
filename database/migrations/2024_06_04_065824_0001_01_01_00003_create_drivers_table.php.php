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
            $table->string('name');
            $table->string('email')->unique(); 
            $table->string('contact'); 
            $table->string('password'); 
            $table->string('avatar')->nullable(); 
            $table->foreignId('car_id')->constrained('cars'); 
            $table->string('nhif_no'); 
            $table->string('nssf_no'); 
            $table->string('kra_pin');
            $table->string('license_no'); 
            $table->date('license_expiry_date');
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