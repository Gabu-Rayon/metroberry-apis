<?php

use App\Models\DriversLicenses;
use App\Models\NTSAInspectionCertificate;
use App\Models\PSVBadge;
use App\Models\VehicleInsurance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    try {
        $licenses = DriversLicenses::where('driving_license_date_of_expiry', '<=', now())->get();
        $psvBadges = PSVBadge::where('psv_badge_date_of_expiry', '<=', now())->get();
        $vehicleInsurances = VehicleInsurance::where('insurance_date_of_expiry', '<=', now())->get();
        $inspCertificates = NTSAInspectionCertificate::where('ntsa_inspection_certificate_date_of_expiry', '<=', now())->get();

        DB::beginTransaction();
        foreach ($licenses as $license) {

            Mail::send('mail-view.license-expiry', ['driver' => $license->driver, 'license' => $license], function ($message) use ($license) {
                $message->to($license->driver->email, $license->driver->name)->subject('Document Expiry Notification');
            });

            $license->verified = false;
            $license->driver->status = 'inactive';
            $license->save();
            $license->driver->save();
        }

        foreach ($psvBadges as $psvBadge) {

            Mail::send('mail-view.psv-badge-expiry', ['driver' => $psvBadge->driver, 'badge' => $psvBadge], function ($message) use ($psvBadge) {
                $message->to($psvBadge->driver->email, $psvBadge->driver->name)->subject('Document Expiry Notification');
            });

            $psvBadge->verified = false;
            $psvBadge->driver->status = 'inactive';
            $psvBadge->save();
            $psvBadge->driver->save();
        }

        foreach ($vehicleInsurances as $insurance) {

            $insurance->verified = false;
            $insurance->vehicle->status = 'inactive';
            $insurance->save();
            $insurance->vehicle->save();
        }

        foreach ($inspCertificates as $certificate) {

            $certificate->verified = false;
            $certificate->vehicle->status = 'inactive';
            $certificate->save();
            $certificate->vehicle->save();
        }

        // send a mail to the admin to notify them of the expired documents

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        Log::info('CHECK DOCUMENTS EXPIRY ');
        Log::error($e->getMessage());
    }
})->daily();
