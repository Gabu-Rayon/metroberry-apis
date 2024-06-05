<?php
// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('cars', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('driver_id')->constrained('drivers');
//             $table->string('type'); 
//             $table->string('license_plate');
//             $table->string('insurance_cover_license');
//             $table->string('insurance_cover_license_expiry_date');
//             $table->string('make_model');
//             $table->text('icon_text');
//             $table->year('year');            
//             $table->integer('capacity'); 
//             $table->integer('engine_size_cc'); 
//             $table->timestamps(); 
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('cars'); // Drops the cars table if it exists
//     }
// };


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
        // Schema::create('vehicles', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('driver_id')->nullable();
        //     $table->string('model');
        //     $table->string('make');
        //     $table->year('year');
        //     $table->string('plate_number');
        //     $table->string('color');
        //     $table->integer('seats');
        //     $table->string('fuel_type');
        //     $table->string('engine_size');
        //     $table->string('status');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};