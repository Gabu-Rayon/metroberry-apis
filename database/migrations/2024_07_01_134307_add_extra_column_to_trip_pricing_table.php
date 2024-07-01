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
        Schema::table('trip_pricing', function (Blueprint $table) {
            $table->unsignedBigInteger('route_id')->nullable()->after('ride_type_id');
            $table->foreign('route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('route_id', function (Blueprint $table) {
            $table->dropColumn([
                'route_id',
            ]);
        });
    }
};