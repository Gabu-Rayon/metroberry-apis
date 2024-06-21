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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable()->unique();
            $table->unsignedBigInteger('created_by');
            $table->string('national_id_no', 20)->unique();
            $table->date('date_of_birth')->format('Ymd');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('national_id_avatar_front');
            $table->string('national_id_avatar_back');
            $table->string('driving_license_no', 20)->unique();
            $table->date('driving_license_date_of_issue')->format('Ymd');
            $table->date('driving_license_date_of_expiry')->format('Ymd');
            $table->string('driving_license_avatar_front');
            $table->string('driving_license_avatar_back');
            $table->string('psv_badge_no', 20)->unique();
            $table->date('psv_badge_date_of_issue')->format('Ymd');
            $table->date('psv_badge_date_of_expiry')->format('Ymd');
            $table->string('psv_badge_avatar');
            $table->string('kra_pin_certificate_no', 20)->unique();
            $table->string('kra_pin_certificate_avatar');
            $table->string('certificate_of_good_conduct_no', 20)->unique();
            $table->date('certificate_of_good_conduct_issue_date')->format('Ymd');
            $table->date('certificate_of_good_conduct_expiry_date')->format('Ymd');
            $table->string('certificate_of_good_conduct_avatar');
            $table->enum('status', ['active', 'inactive'])->default('inactive');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('drivers');
    }
};