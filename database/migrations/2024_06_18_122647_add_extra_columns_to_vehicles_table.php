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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dateTime('vehicle_insurance_issue_date')->nullable()->after('engine_size');
            $table->dateTime('vehicle_insurance_expiry')->nullable()->after('vehicle_insurance_issue_date');
            $table->string('vehicle_insurance_issue_organisation')->nullable()->after('vehicle_insurance_expiry');
            $table->string('vehicle_avatar')->nullable()->after('vehicle_insurance_issue_organisation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'vehicle_insurance_issue_date',
                'vehicle_insurance_expiry',
                'vehicle_insurance_issue_organisation',
            ]);
        });
    }
};