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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('national_id_front_avatar')->nullable()->after('customer_organisation_code');
            $table->string('national_id_behind_avatar')->nullable()->after('national_id_front_avatar');
            $table->tinyInteger('terms_and_conditions')->nullable()->after('national_id_behind_avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'national_id_front_avatar',
                'national_id_behind_avatar',
                'terms_and_conditions',
            ]);
        });
    }
};