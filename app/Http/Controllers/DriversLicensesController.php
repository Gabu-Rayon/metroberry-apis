<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\DriversLicenses;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DriversLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licenses = DriversLicenses::all();
        return view('driver.license.index',compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $drivers = Driver::all();
        return view('driver.license.create',compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'driver' => 'required|numeric|exists:drivers,id',
                'license_no' => 'required|string|unique:drivers_licenses,driving_license_no',
                'issue_date' => 'required|date',
                'expiry_date' => 'required|date|after:issue_date',
                'front_page_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'back_page_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                Log::error('CREATE LICENSE VALIDATION ERROR');
                Log::error($validator->errors()->first());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $frontLicensePath = null;
            $backLicensePath = null;
            $licenseNumber = $data['license_no'];

            if ($request->hasFile('front_page_id')) {
                $frontLicenseFile = $request->file('front_page_id');
                $frontLicenseExtension = $frontLicenseFile->getClientOriginalExtension();
                $frontLicenseFileName = "{$licenseNumber}-front-id.{$frontLicenseExtension}";
                $frontLicensePath = $frontLicenseFile->storeAs('uploads/front-license-pics', $frontLicenseFileName, 'public');
            }

            if ($request->hasFile('back_page_id')) {
                $backLicenseFile = $request->file('back_page_id');
                $backLicenseExtension = $backLicenseFile->getClientOriginalExtension();
                $backLicenseFileName = "{$licenseNumber}-back-id.{$backLicenseExtension}";
                $backLicensePath = $backLicenseFile->storeAs('uploads/back-license-pics', $backLicenseFileName, 'public');
            }

            DB::beginTransaction();

            DriversLicenses::create([
                'driver_id' => $data['driver'],
                'driving_license_no' => $licenseNumber,
                'driving_license_date_of_issue' => $data['issue_date'],
                'driving_license_date_of_expiry' => $data['expiry_date'],
                'driving_license_avatar_front' => $frontLicensePath,
                'driving_license_avatar_back' => $backLicensePath,
            ]);

            DB::commit();

            return redirect()->route('driver.license')->with('success', 'License created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CREATE LICENSE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriversLicenses $driversLicenses)
    {
        //
    }
}