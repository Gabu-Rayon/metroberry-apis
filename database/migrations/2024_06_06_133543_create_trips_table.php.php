<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('preferred_route')->nullable();
            $table->time('pick_up_time')->nullable();
            $table->date('drop_off_or_pick_up_date')->nullable();
            $table->enum('pick_up_points', ['Home', 'Office'])->nullable();
            $table->string('pick_up_location')->nullable();// should reference their home location || office location 
            $table->string('drop_off_location')->nullable();
            $table->float('mileage_gps')->nullable();
            $table->float('mileage_can')->nullable();
            $table->float('engine_hours_gps')->nullable();
            $table->float('engine_hours_can')->nullable();
            $table->float('can_distance_till_service')->nullable();
            $table->float('average_fuel_consumption_litre_per_km')->nullable();
            $table->float('average_fuel_consumption_litre_per_hour')->nullable();
            $table->float('average_fuel_consumption_kg_per_km')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};