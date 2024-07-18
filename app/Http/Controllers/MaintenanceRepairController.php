<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRepair;
use App\Models\Vehicle;
use App\Models\VehiclePart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MaintenanceRepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $maintenanceRepairs = MaintenanceRepair::all();
        return view('vehicle.maintenance-repairs.index', compact('maintenanceRepairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $vehicles = Vehicle::all();
        $parts = VehiclePart::all();
        return view('vehicle.maintenance-repairs.create', compact('vehicles', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle' => 'required|numeric|exists:vehicles,id',
                'part' => 'required|numeric|exists:vehicle_parts,id',
                'creator_id' => 'required|numeric|exists:users,id',
                'repair_date' => 'required|date',
                'cost' => 'required|numeric',
                'description' => 'nullable|string',
                'repair_type' => 'required|string|in:repair,replacement,refill',
                'amount' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            MaintenanceRepair::create([
                'vehicle_id' => $data['vehicle'],
                'part_id' => $data['part'],
                'creator_id' => $data['creator_id'],
                'repair_date' => $data['repair_date'],
                'repair_cost' => $data['cost'],
                'repair_description' => $data['description'],
                'repair_type' => $data['repair_type'],
                'amount' => $data['amount'],
            ]);

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair added successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info('STORE MAINTENANCE REPAIR ERROR');
            Log::info($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceRepair $maintenanceRepair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $repair = MaintenanceRepair::findOrFail($id);
        $vehicles = Vehicle::all();
        $parts = VehiclePart::all();
        return view('vehicle.maintenance-repairs.edit', compact('repair', 'vehicles', 'parts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle_id' => 'required|numeric|exists:vehicles,id',
                'part_id' => 'required|numeric|exists:vehicle_parts,id',
                'creator_id' => 'required|numeric|exists:users,id',
                'repair_date' => 'required|date',
                'cost' => 'required|numeric',
                'description' => 'nullable|string',
                'repair_type' => 'required|string|in:repair,replacement,refill',
                'amount' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            $maintenanceRepair = MaintenanceRepair::findOrFail($id);

            $maintenanceRepair->vehicle_id = $data['vehicle_id'];
            $maintenanceRepair->part_id = $data['part_id'];
            $maintenanceRepair->creator_id = $data['creator_id'];
            $maintenanceRepair->repair_date = $data['repair_date'];
            $maintenanceRepair->repair_cost = $data['cost'];
            $maintenanceRepair->repair_description = $data['description'];
            $maintenanceRepair->repair_type = $data['repair_type'];
            $maintenanceRepair->amount = $data['amount'];
            $maintenanceRepair->repair_status = 'pending';

            $maintenanceRepair->save();

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('UPDATE MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function redoForm($id) {
        $maintenanceRepair = MaintenanceRepair::findOrFail($id);
        return view('vehicle.maintenance-repairs.redo', compact('maintenanceRepair'));
    }

    public function redo(Request $request, $id) {
        try {

            $maintenanceRepair = MaintenanceRepair::findOrFail($id);
            $data = $request->all();

            $validator = Validator::make($data, [
                'creator_id' => 'required|numeric|exists:users,id',
                'description' => 'nullable|string|max:255',
                'repair_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            MaintenanceRepair::create([
                'vehicle_id' => $maintenanceRepair->vehicle_id,
                'part_id' => $maintenanceRepair->part_id,
                'creator_id' => $data['creator_id'],
                'repair_date' => $data['repair_date'],
                'repair_cost' => $maintenanceRepair->repair_cost,
                'repair_description' => $data['description'],
                'repair_type' => $maintenanceRepair->repair_type,
                'amount' => $maintenanceRepair->amount,
            ]);

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair added successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('REDO MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function approveForm($id) {
        $maintenanceRepair = MaintenanceRepair::findOrFail($id);
        return view('vehicle.maintenance-repairs.approve', compact('maintenanceRepair'));
    }

    public function approve($id) {
        try {
            $maintenanceRepair = MaintenanceRepair::findOrFail($id);

            DB::beginTransaction();

            $maintenanceRepair->repair_status = 'approved';

            $maintenanceRepair->save();

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair approved successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('APPROVE MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }
    
    public function rejectForm($id) {
        $maintenanceRepair = MaintenanceRepair::findOrFail($id);
        return view('vehicle.maintenance-repairs.reject', compact('maintenanceRepair'));
    }

    public function reject($id) {
        try {
            $maintenanceRepair = MaintenanceRepair::findOrFail($id);

            DB::beginTransaction();

            $maintenanceRepair->repair_status = 'rejected';

            $maintenanceRepair->save();

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair rejected successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('REJECT MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function billForm($id) {
        $maintenanceRepair = MaintenanceRepair::findOrFail($id);
        return view('vehicle.maintenance-repairs.bill', compact('maintenanceRepair'));
    }

    public function bill($id) {
        try {
            $maintenanceRepair = MaintenanceRepair::findOrFail($id);

            if ($maintenanceRepair->repair_type == 'refill' || $maintenanceRepair->repair_type == 'replacement') {
                if ($maintenanceRepair->part->quantity < $maintenanceRepair->amount) {
                    return redirect()->back()->with('error', 'Part out of stock.');
                }
            }

            DB::beginTransaction();

            $maintenanceRepair->part->quantity -= $maintenanceRepair->amount;

            $maintenanceRepair->repair_status = 'billed';

            $maintenanceRepair->part->save();

            $maintenanceRepair->save();

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair billed successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('BILL MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function delete($id) {
        $maintenanceRepair = MaintenanceRepair::findOrFail($id);
        return view('vehicle.maintenance-repairs.delete', compact('maintenanceRepair'));
    }
    public function destroy($id){
        try {
            $maintenanceRepair = MaintenanceRepair::findOrFail($id);

            if ($maintenanceRepair->repair_status == 'billed') {
                return redirect()->back()->with('error', 'Cannot delete billed maintenance repair.');
            }

            if ($maintenanceRepair->repair_status == 'rejected') {
                return redirect()->back()->with('error', 'Cannot delete rejected maintenance repair.');
            }

            DB::beginTransaction();

            $maintenanceRepair->delete();

            DB::commit();

            return redirect()->route('maintenance.repair')->with('success', 'Maintenance Repair deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('DELETE MAINTENANCE REPAIR ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
