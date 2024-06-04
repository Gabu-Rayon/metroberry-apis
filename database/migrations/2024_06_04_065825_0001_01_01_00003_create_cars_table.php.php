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
            $table->string('make_model');
            $table->text('icon_text');
            $table->year('year'); 
            $table->integer('mileage_gps');
            $table->integer('mileage_can');
            $table->integer('engine_hours_gps');
            $table->integer('engine_hours_can'); 
            $table->integer('can_distance_till_service');
            $table->decimal('total_repairs_costs', 10, 2); 
            $table->decimal('avg_fuel_consumption_l_per_100km', 5, 2); 
            $table->decimal('avg_fuel_consumption_l_per_hour', 5, 2);
            $table->decimal('avg_fuel_consumption_kg_per_100km', 5, 2);            
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