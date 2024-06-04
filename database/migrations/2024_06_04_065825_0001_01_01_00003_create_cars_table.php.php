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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers');
            $table->string('type'); 
            $table->string('license_plate');
            $table->string('insurance_cover_license');
            $table->string('insurance_cover_license_expiry_date');
            $table->string('make_model');
            $table->text('icon_text');
            $table->year('year');            
            $table->integer('capacity'); 
            $table->integer('engine_size_cc'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars'); // Drops the cars table if it exists
    }
};