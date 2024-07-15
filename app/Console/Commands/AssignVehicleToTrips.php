<?php

namespace App\Console\Commands;

use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignVehicleToTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:assign-vehicle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign vehicles to trips one hour before trip time';

    /**
     * Execute the console command.
     */
    public function handle(){
        try {
            $currentTime = Carbon::now();
            $oneHourBefore = $currentTime->copy()->subHour();

            $trips = Trip::where(function ($query) {
                $query->whereNull('vehicle_id');
            })
            ->where(function ($query) use ($oneHourBefore) {
                $query->where('pick_up_time', '<=', $oneHourBefore);
            })
            ->where('trip_date', Carbon::today())
            ->get();

            $vehicles = null;

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
    }
}
