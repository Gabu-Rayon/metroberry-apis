<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\ServiceTypeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $serviceCategories = ServiceTypeCategory::all();
        return view('vehicle.maintenance.service.categories.index', compact('serviceCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $serviceTypes = ServiceType::all();
        return view('vehicle.maintenance.service.categories.create', compact('serviceTypes'));
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
                'serviceType' => 'required|exists:service_types,id',
            ]);

            if ($validator->fails()) {
                Log::error('STORE SERVICE CATEGORY VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            ServiceTypeCategory::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'service_type_id' => $data['serviceType'],
            ]);

            DB::commit();

            return redirect()->route('vehicle.maintenance.service.categories')->with('success', 'Service Category created successfully');
        } catch (Exception $e) {
            Log::info('STORE SERVICE CATEGORY ERROR');
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
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
