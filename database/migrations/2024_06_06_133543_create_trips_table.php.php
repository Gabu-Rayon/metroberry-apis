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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('route_id');
            $table->dateTime('pick_up_time');
            $table->dateTime('drop_off_time')->nullable();
            $table->integer('distance')->nullable();
            $table->integer('number_of_passengers')->nullable();
            $table->string('pick_up_location');
            $table->string('drop_off_location');
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'billed'])->default('scheduled');
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