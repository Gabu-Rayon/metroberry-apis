<?php

use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

Schedule::call(function () {
    Log::info('Scheduled task started');
    try {
        $currentTime = Carbon::now('Africa/Nairobi')->format('H:i:s');
        $oneHourLater = Carbon::now('Africa/Nairobi')->addHour()->format('H:i:s');

        $currentTime = Carbon::now('Africa/Nairobi');
        $oneHourLater = $currentTime->copy()->addHour();

        $trips = Trip::whereNull('vehicle_id')
            ->whereBetween('pick_up_time', [$currentTime, $oneHourLater])
            ->whereDate('trip_date', Carbon::today('Africa/Nairobi'))
            ->where('status', 'scheduled')
            ->get();

        $vehicles = null;

        if (!$trips || $trips->count() == 0) {
            Log::info('NO SCHEDULED TRIPS');
        }

        if ($trips->count() >= 1 && $trips->count() <= 4) {
            $vehicles = Vehicle::where('status', 'active')
                ->where('class', '>=', 'A')
                ->get();
        }

        if ($trips->count() >= 5 && $trips->count() <= 6) {
            $vehicles = Vehicle::where('status', 'active')
                ->where('class', '>=', 'B')
                ->where('isOccupied', false)
                ->get();
        }

        if ($trips->count() >= 7 && $trips->count() <= 14) {
            $vehicles = Vehicle::where('status', 'active')
                ->where('class', '>=', 'C')
                ->get();
        }

        DB::beginTransaction();
        if ($vehicles) {
            foreach ($trips as $trip) {
                $vehicle = $vehicles->random();
                $trip->vehicle_id = $vehicle->id;
                $trip->save();
            }
        }
        DB::commit();

        Log::info('VEHICLES ASSIGNED TO TRIPS');
    } catch (Exception $e) {
        Log::info('ERROR ASSIGNING VEHICLE TO TRIPS');
        Log::error($e->getMessage());
    }
})->everyMinute();
