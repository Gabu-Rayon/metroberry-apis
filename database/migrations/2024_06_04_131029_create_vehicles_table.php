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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->unique()->nullable();
            $table->unsignedBigInteger('organisation_id')->unique()->nullable();
            $table->unsignedBigInteger('created_by');
            $table->string('make', 50);
            $table->string('model', 50);
            $table->year('year');
            $table->string('color', 50);
            $table->tinyInteger('seats');
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric']);
            $table->decimal('engine_size', 5, 2);
            $table->string('vehicle_avatar');
            $table->string('plate_number', 20)->unique();
            $table->string('logbook_avatar');
            $table->string('insurance_company', 50);
            $table->string('insurance_policy_no', 20)->unique();
            $table->date('insurance_date_of_issue')->format('Ymd');
            $table->date('insurance_date_of_expiry')->format('Ymd');
            $table->string('insurance_avatar');
            $table->string('ntsa_inspection_certificate_no', 20)->unique();
            $table->date('ntsa_inspection_certificate_date_of_issue')->format('Ymd');
            $table->date('ntsa_inspection_certificate_date_of_expiry')->format('Ymd');
            $table->string('ntsa_inspection_certificate_avatar');
            $table->enum('status', ['active', 'inactive'])->default('inactive');

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
