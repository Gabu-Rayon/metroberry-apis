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
        // Schema::create('trips', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('customer_id');
        //     $table->string('customer_organisation_code');
        //     $table->string('customer_contact');
        //     $table->text('home_address');
        //     $table->unsignedBigInteger('car_id');
        //     $table->string('car_class');
        //     $table->unsignedBigInteger('driver_id');
        //     $table->string('car_license_plate');
        //     $table->string('preferred_route');
        //     $table->time('pick_up_time');
        //     $table->date('drop_off_or_pick_up_date');
        //     $table->enum('pick_up_location', ['Home', 'Office']);
        //     $table->float('mileage_gps');
        //     $table->float('mileage_can');
        //     $table->float('engine_hours_gps');
        //     $table->float('engine_hours_can');
        //     $table->float('can_distance_till_service');
        //     $table->float('average_fuel_consumption_litre_per_km');
        //     $table->float('average_fuel_consumption_litre_per_hour');
        //     $table->float('average_fuel_consumption_kg_per_km');
        //     $table->timestamps();

        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        //     $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        //     $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};