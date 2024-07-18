<?php

namespace App\Http\Controllers;

use App\Models\DriversLicenses;
use App\Models\MaintenanceRepair;
use App\Models\MaintenanceService;
use App\Models\NTSAInspectionCertificate;
use App\Models\PSVBadge;
use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\VehicleInsurance;
use App\Models\VehicleRefueling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){


        $user = Auth::user();

        if ($user->role == 'organisation') {
            return redirect()->route('organisation.dashboard');
        }
        
        $activeVehicles = Vehicle::where('status', 'active')->get();
        $inactiveVehicles = Vehicle::where('status', 'inactive')->get();
        $tripsThisMonth = Trip::whereMonth('created_at', date('m'))->get();
        $services = MaintenanceService::where('service_status', 'billed')->get();
        $repairs = MaintenanceRepair::where('repair_status', 'billed')->get();
        $refuelings = VehicleRefueling::where('status', 'billed')->get();
        $scheduledTrips = $tripsThisMonth->filter(function($trip) {
            return $trip->status == 'scheduled';
        });
        $completedTrips = $tripsThisMonth->filter(function($trip) {
            return $trip->status == 'completed';
        });
        $cancelledTrips = $tripsThisMonth->filter(function($trip) {
            return $trip->status == 'cancelled';
        });
        $billedTrips = $tripsThisMonth->filter(function($trip) {
            return $trip->status == 'billed';
        });
        $totalIncome = $billedTrips->sum(function ($trip) {
            return $trip->total_price;
        });
        $totalExpense = $services->sum(function ($service) {
            return $service->service_cost;
        });
        $totalExpense += $repairs->sum(function ($repair) {
            return $repair->repair_cost;
        });
        $totalExpense += $refuelings->sum(function ($refueling) {
            return $refueling->refuelling_cost;
        });
        $expiredInsurances = VehicleInsurance::where('insurance_date_of_expiry', '<', date('Y-m-d'))->get();
        $expiredInspectionCertificates = NTSAInspectionCertificate::where('ntsa_inspection_certificate_date_of_expiry', '<', date('Y-m-d'))->get();
        $expiredLicenses = DriversLicenses::where('driving_license_date_of_expiry', '<', date('Y-m-d'))->get();
        $expiredPSVBadges = PSVBadge::where('psv_badge_date_of_expiry', '<', date('Y-m-d'))->get();      

        return view('dashboard', compact(
            'activeVehicles',
            'inactiveVehicles',
            'tripsThisMonth',
            'scheduledTrips',
            'completedTrips',
            'cancelledTrips',
            'billedTrips',
            'expiredInsurances',
            'expiredInspectionCertificates',
            'expiredLicenses',
            'expiredPSVBadges',
            'totalIncome',
            'totalExpense'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
