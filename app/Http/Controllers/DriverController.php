<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Driver;
use App\Models\Organisation;
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
        $drivers = Driver::with('user')->get();
        return view('driver.index', compact('drivers'));
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
                'created_by' => 1,
                'role' => 'driver',
            ]);

            $user->assignRole('driver');

            Driver::create([
                'created_by' => 1,
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
        $organisations = Organisation::all();
        return view('driver.create', compact('organisations'));
    }


    public function edit($id){
        $driver = Driver::findOrfail($id);
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
                'national_id_no' => 'required|string|unique:drivers,national_id_no,' . $driver->id,
                'front_page_id' => 'nullable|file|mimes:jpg,jpeg,png,webp',
                'back_page_id' => 'nullable|file|mimes:jpg,jpeg,png,webp',
                'avatar' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

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

            return redirect()->route('driver')->with('success', 'Customer updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('UPDATE DRIVER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred');
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try {
            $driver->user->delete();
            $driver->delete();

            return response()->json([
                'message' => 'Driver deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('DELETE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function driverPerformance(){
        return view('driver.performance');
    }

     public function createDriverPerformance(){
        return view('driver.performance.create');
     }
}