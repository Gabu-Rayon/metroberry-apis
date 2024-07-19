<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceService;
use App\Models\ServiceType;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MaintenanceServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $maintenanceServices = MaintenanceService::with('vehicle', 'creator')->get();
        return view('vehicle.maintenance-services.index', compact('maintenanceServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $vehicles = Vehicle::all();
        $serviceTypes = ServiceType::all();
        return view('vehicle.maintenance-services.create', compact('vehicles', 'serviceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle' => 'required|numeric|exists:vehicles,id',
                'service_type_id' => 'required|numeric|exists:service_types,id',
                'service_date' => 'required|date',
                'service_description' => 'required|string|max:255',
                'service_category_id' => 'required|numeric|exists:service_type_categories,id',
                'service_cost' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', 'Validation error');
            }
            
            DB::beginTransaction();

            MaintenanceService::create([
                'vehicle_id' => $data['vehicle'],
                'creator_id' => auth()->id(),
                'service_type_id' => $data['service_type_id'],
                'service_category_id' => $data['service_category_id'],
                'service_date' => $data['service_date'],
                'service_cost' => $data['service_cost'],
                'service_description' => $data['service_description'],
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('STORE MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceService $maintenanceService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceService $maintenanceService)
    {
        //
    }

    public function approveForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.approve', compact('service'));
    }

    public function approve($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'approved'
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service approved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('APPROVE MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function rejectForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.reject', compact('service'));
    }

    public function reject($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'rejected',
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service rejected successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('REJECT MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function billForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.bill', compact('service'));
    }

    public function bill($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'billed',
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service billed successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('BILL MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceService $maintenanceService)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceService $maintenanceService)
    {
        //
    }
}
