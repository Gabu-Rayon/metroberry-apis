<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Driver;
use App\Models\Organisation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            try {
                $drivers = null;

                // Check the user's role
                if (Auth::user()->role == 'admin') {
                    // If the user is an admin, fetch all drivers
                    $drivers = Driver::with('user')->get();
                } elseif (Auth::user()->role == 'organisation') {
                    // If the user is an organisation, fetch drivers for that organisation
                    // Assuming organisation_id in Driver references the organisation table
                    $drivers = Driver::whereHas('user', function ($query) {
                        $query->where('organisation_id', Auth::user()->organisation->id);
                    })->with('user')->get();
                } else {
                    // If the user has another role, fetch drivers created by the user
                    $drivers = Driver::where('created_by', Auth::user()->id)->with('user')->get();
                }

                Log::info('Drivers fetched: ', ['drivers' => $drivers]);

                return view('driver.index', compact('drivers'));
            } catch (Exception $e) {
                // Log the error message
                Log::error('Error fetching drivers: ' . $e->getMessage());

                return back()->with('error', 'An error occurred while fetching the drivers. Please try again.');
            }
        
    }

    public function store(Request $request)
    {
        try {
            
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|string',
                'phone' => 'required|string',
                'organisation' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'address' => 'nullable|string',
                'national_id' => 'required|string',
                'front_page_id' => 'required|file|mimes:jpg,jpeg,png,webp',
                'back_page_id' => 'required|file|mimes:jpg,jpeg,png,webp',
                'avatar' => 'nullable|file|mimes:jpg,jpeg,png,webp',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $organisation = Organisation::where('organisation_code', $data['organisation'])->first();

            if (!$organisation) {
                return redirect()->back()->with('error', 'Organisation not found')->withInput();
            }

            $frontIdPath = null;
            $backIdPath = null;
            $avatarPath = null;
            $email = $data['email'];

            if ($request->hasFile('front_page_id')) {
                $frontIdFile = $request->file('front_page_id');
                $frontIdExtension = $frontIdFile->getClientOriginalExtension();
                $frontIdFileName = "{$email}-front-id.{$frontIdExtension}";
                $frontIdPath = $frontIdFile->storeAs('uploads/front-page-ids', $frontIdFileName, 'public');
            }
            
            if ($request->hasFile('back_page_id')) {
                $backIdFile = $request->file('back_page_id');
                $backIdExtension = $backIdFile->getClientOriginalExtension();
                $backIdFileName = "{$email}-back-id.{$backIdExtension}";
                $backIdPath = $backIdFile->storeAs('uploads/back-page-ids', $backIdFileName, 'public');
            }
            
            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $avatarExtension = $avatarFile->getClientOriginalExtension();
                $avatarFileName = "{$email}-avatar.{$avatarExtension}";
                $avatarPath = $avatarFile->storeAs('uploads/user-avatars', $avatarFileName, 'public');
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $avatarPath,
                'created_by' => Auth::user()->id,
                'role' => 'driver',
            ]);

            $user->assignRole('driver');

            Driver::create([
                'created_by' => Auth::user()->id,
                'user_id' => $user->id,
                'organisation_id' => $organisation->id,
                'national_id_no' => $data['national_id'],
                'national_id_front_avatar' => $frontIdPath,
                'national_id_behind_avatar' => $backIdPath,
            ]);

            DB::commit();

            return redirect()->route('driver')->with('success', 'Driver created successfully');
        } catch (Exception $e) {
            Log::error('CREATE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        try {
            return response()->json([
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            Log::error('SHOW DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create(){
        $organisations = Organisation::where('status', 'active')->get();
        return view('driver.create', compact('organisations'));
    }


    public function edit($id){
        $driver = Driver::with('vehicle')->findOrfail($id);
        Log::info('DRIVER');
        Log::info($driver);
        $organisations = Organisation::all();
        return view('driver.edit', compact('driver', 'organisations'));
    }

    public function update(Request $request, $id){
        try {

            $driver = Driver::find($id);
            $user = User::find($driver->user_id);
            $data = $request->all();
            $organisation = Organisation::where('organisation_code', $data['organisation'])->first();

            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }


            if (!$organisation) {
                return redirect()->back()->with('error', 'Organisation not found');
            }

            $validator = Validator::make($data, [
                'name' => 'required|string',
                'phone' => 'required|string',
                'organisation' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'address' => 'nullable|string',
                'national_id_no' => 'required|string',
                'front_page_id' => 'nullable|file|mimes:jpg,jpeg,png,webp',
                'back_page_id' => 'nullable|file|mimes:jpg,jpeg,png,webp',
                'avatar' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            Log::info('UPDATE DRIVER');
            Log::info($data);

            Log::info('DRIVER');
            Log::info($driver);

            DB::beginTransaction();

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $driver->national_id_no = $data['national_id_no'];

            $avatarPath = null;
            $frontIdPath = null;
            $backIdPath = null;
            $email = $data['email'];

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $avatarExtension = $avatarFile->getClientOriginalExtension();
                $avatarFileName = "{$email}-avatar.{$avatarExtension}";
                $avatarPath = $avatarFile->storeAs('uploads/user-avatars', $avatarFileName, 'public');
                $user->avatar = $avatarPath;
            }

            if ($request->hasFile('front_page_id')) {
                $frontIdFile = $request->file('front_page_id');
                $frontIdExtension = $frontIdFile->getClientOriginalExtension();
                $frontIdFileName = "{$email}-front-id.{$frontIdExtension}";
                $frontIdPath = $frontIdFile->storeAs('uploads/front-page-ids', $frontIdFileName, 'public');
                $driver->national_id_front_avatar = $frontIdPath;
            }

            if ($request->hasFile('back_page_id')) {
                $backIdFile = $request->file('back_page_id');
                $backIdExtension = $backIdFile->getClientOriginalExtension();
                $backIdFileName = "{$email}-back-id.{$backIdExtension}";
                $backIdPath = $backIdFile->storeAs('uploads/back-page-ids', $backIdFileName, 'public');
                $driver->national_id_behind_avatar = $backIdPath;
            }

            $driver->save();
            $user->save();

            DB::commit();

            return redirect()->route('driver')->with('success', 'Driver updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('UPDATE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function assignVehicleForm($id){
        $driver = Driver::with('vehicle')->findOrfail($id);
        $vehicles = Vehicle::where('status', 'active')
                  ->doesntHave('driver')
                  ->get();
        return view('driver.assign-vehicle', compact('driver', 'vehicles'));
    }

    public function assignVehicle(Request $request, $id) {
        try {

            $driver = Driver::find($id);
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle_id' => 'required|exists:vehicles,id',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }

            $vehicle = Vehicle::find($data['vehicle_id']);

            if (!$vehicle) {
                return redirect()->back()->with('error', 'Vehicle not found');
            }

            if ($vehicle->driver) {
                return redirect()->back()->with('error', 'Vehicle is already assigned to another driver');
            }

            DB::beginTransaction();

            $vehicle->driver_id = $driver->id;
            $vehicle->save();

            DB::commit();

            return redirect()->route('driver')->with('success', 'Vehicle assigned successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ASSIGN VEHICLE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $driver = Driver::find($id);

            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }

            $user = User::find($driver->user_id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            DB::beginTransaction();

            $driver->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('driver')->with('success', 'Driver deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('DELETE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function driverPerformance(){
        $drivers = Driver::with('user', 'vehicle')->get();
        return view('driver.performance.index', compact('drivers'));
    }

     public function createDriverPerformance(){
        return view('driver.performance.create');
     }

    /**
     * Activate driver
     */

    public function activateForm ($id) {
        $driver = Driver::findOrfail($id);
        return view('driver.activate', compact('driver'));
    }

    public function activate ($id) {
        try {

            $driver = Driver::with('driverLicense')->findOrFail($id);

            Log::info('ACTIVATE DRIVER');
            Log::info($driver);

            Log::info('DRIVER LICENSE');
            Log::info($driver->driverLicense);

            if ($driver->status == 'active') {
                return redirect()->back()->with('error', 'Driver is already active');
            }

            if (!$driver->driverLicense) {
                return redirect()->back()->with('error', 'Driver does not have a license');
            }

            if ($driver->driverLicense->driving_license_date_of_expiry < date('Y-m-d')) {
                return redirect()->back()->with('error', 'Driver license has expired');
            }

            if (!$driver->driverLicense->driving_license_avatar_front || !$driver->driverLicense->driving_license_avatar_back) {
                return redirect()->back()->with('error', 'Driver license documents are missing');
            }

            if ($driver->driverLicense->verified == false) {
                return redirect()->back()->with('error', 'Driver license has not been verified');
            }

            if (!$driver->psvBadge) {
                return redirect()->back()->with('error', 'Driver does not have a PSV Badge');
            }

            if ($driver->psvBadge->psv_badge_date_of_expiry < date('Y-m-d')) {
                return redirect()->back()->with('error', 'Driver PSV Badge has expired');
            }

            if (!$driver->psvBadge->psv_badge_avatar) {
                return redirect()->back()->with('error', 'Driver PSV Badge documents are missing');
            }

            if ($driver->psvBadge->verified == false) {
                return redirect()->back()->with('error', 'Driver PSV Badge has not been verified');
            }

            DB::beginTransaction();

            $driver->status = 'active';

            $driver->save();

            DB::commit();

            return redirect()->route('driver')->with('success', 'Driver activated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ACTIVATE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function deactivateForm ($id) {
        $driver = Driver::findOrfail($id);
        return view('driver.deactivate', compact('driver'));
    }

    /**
     * Deactivate driver
     */

    public function deactivate ($id) {
        try {

            $driver = Driver::findOrfail($id);

            if ($driver->status == 'inactive') {
                return redirect()->back()->with('error', 'Driver is already inactive');
            }

            DB::beginTransaction();

            $driver->status = 'inactive';

            $driver->save();

            DB::commit();

            return redirect()->route('driver')->with('success', 'Driver deactivated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('DEACTIVATE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

}