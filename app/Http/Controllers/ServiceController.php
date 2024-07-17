<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $serviceTypes = ServiceType::all();
        return view('vehicle.maintenance.service.index', compact('serviceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('vehicle.maintenance.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            ServiceType::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            DB::commit();

            return redirect()->route('vehicle.maintenance.service')->with('success', 'Service Type Created Successfully');
        } catch (Exception $e) {
            Log::error('ERROR STORING SERVICE TYPE');
            lOG::error($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
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
