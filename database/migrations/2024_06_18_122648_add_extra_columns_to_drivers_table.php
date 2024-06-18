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
        Schema::table('drivers', function (Blueprint $table) {
            $table->integer('national_id_no')->nullable()->after('user_id');
            $table->string('national_id_avatar_front')->nullable()->after('national_id_no');
            $table->string('national_id_avatar_behind')->nullable()->after('national_id_avatar_front');
            $table->string('sex')->nullable()->after('national_id_avatar_behind');

            $table->string('date_of_birth')->nullable()->after('sex');

            $table->integer('driving_license_no')->nullable()->after('date_of_birth');
            $table->dateTime('driving_license_date_issued')->nullable()->after('driving_license_no');
            $table->dateTime('driving_license_date_expiry')->nullable()->after('driving_lincense_date_issued');
            
            $table->string('dl_county_of_residence')->nullable()->after('driving_lincense_date_expiry');
            $table->string('dl_avatar_front')->nullable()->after('dl_county_of_residence');
            $table->string('dl_avatar_behind')->nullable()->after('dl_avatar_front');
            $table->string('ntsa_inspection_certificate')->nullable()->after('dl_avatar_behind');
            $table->string('logbook_copy')->nullable()->after('ntsa_inspection_certificate');
            $table->integer('ntsa_psv_badge')->nullable()->after('logbook_copy');
            $table->dateTime('travel_passport')->nullable()->after('ntsa_psv_badge');
            $table->dateTime('certificate_of_good_conduct')->nullable()->after('travel_passport');
            $table->string('kra_pin_certificate')->nullable()->after('certificate_of_good_conduct');
            $table->tinyInteger('terms_and_conditions')->nullable()->after('kra_pin_certificate');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'national_id_no',
                'national_id_avatar_front',
                'national_id_avatar_behind',
                'sex',
                'date_of_birth',
                'driving_license_no',
                'driving_lincense_date_issued',
                'driving_lincense_date_expiry',
                'dl_county_of_residence',
                'dl_avatar_front',
                'dl_avatar_behind',
                'ntsa_inspection_certificate',
                'logbook_copy',
                'ntsa_psv_badge',
                'travel_passport',
                'certificate_of_good_conduct',
                'kra_pin_certificate',
                'terms_and_conditions'
            ]);
        });
    }
};