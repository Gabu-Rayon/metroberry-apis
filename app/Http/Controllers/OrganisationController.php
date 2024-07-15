<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard () {
        return view('organisation.dashboard');
    }

    public function index(){

        $organisations = Organisation::where('created_by', Auth::user()->id)->get();
        return view('organisation.index',compact('organisations'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organisation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email|unique:users',
                'address' => 'required|string',
                'logo' => 'required|file|mimes:jpeg,jpg,png,gif,webp|max:2048',
                'organisation_certificate' => 'required|file|mimes:pdf|max:2048',
                'organisation_code' => 'required|string|unique:organisations',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            $logoPath = null;
            $email = $data['email'];

            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                $logoExtension = $logoFile->getClientOriginalExtension();
                $logoFileName = "{$email}-avatar.{$logoExtension}";
                $logoPath = $logoFile->storeAs('uploads/company-logos', $logoFileName, 'public');
            }

            if ($request->hasFile('organisation_certificate')) {
                $certificateFile = $request->file('organisation_certificate');
                $certificateExtension = $certificateFile->getClientOriginalExtension();
                $certificateFileName = "{$email}-certificate.{$certificateExtension}";
                $certificatePath = $certificateFile->storeAs('uploads/organisation-certificates', $certificateFileName, 'public');
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'address' => $data['address'],
                'role' => 'organisation',
                'avatar' => $logoPath,
                'created_by' => Auth::user()->id
            ]);

            $user->assignRole('organisation');

            Organisation::create([
                'user_id' => $user->id,
                'certificate_of_organisation' => $certificatePath,
                'billing_cycle' => null,
                'terms_and_conditions' => null,
                'created_by' => Auth::user()->id,
                'organisation_code' => $data['organisation_code']
            ]);

            DB::commit();

            return redirect()->route('organisation')->with('success', 'Organisation created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error Creating Organisation');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred while creating organisation');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $organisation = Organisation::where('id', $id)->first();
            if (!$organisation) {
                return response()->json([
                    'message' => 'Organisation not found'
                ], 404);
            }
            $organisation->load('user');
            return response()->json([
                'organisation' => $organisation
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING Organisation');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while fetching organisation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $organisation = Organisation::findOrfail($id);
        return view('organisation.edit',compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        try {

            $organisation = Organisation::findOrfail($id);
            $user = User::findOrfail($organisation->user_id);

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'address' => 'required|string',
                'logo' => 'file|mimes:jpeg,jpg,png,gif,webp|max:2048',
                'certificate_of_organisation' => 'file|mimes:pdf|max:2048',
                'organisation_code' => 'required|string|unique:organisations,organisation_code,' . $organisation->id,
            ]);

            if ($validator->fails()) {
                Log::info('VALIDATION ERRORS');
                Log::info($validator->errors()->first());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            $logoPath = $user->avatar;

            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                $logoExtension = $logoFile->getClientOriginalExtension();
                $logoFileName = "{$user->email}-avatar.{$logoExtension}";
                $logoPath = $logoFile->storeAs('uploads/company-logos', $logoFileName, 'public');
            }

            if ($request->hasFile('certificate_of_organisation')) {
                $certificateFile = $request->file('certificate_of_organisation');
                $certificateExtension = $certificateFile->getClientOriginalExtension();
                $certificateFileName = "{$user->email}-certificate.{$certificateExtension}";
                $certificatePath = $certificateFile->storeAs('uploads/organisation-certificates', $certificateFileName, 'public');
            }

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $logoPath
            ]);

            $organisation->update([
                'certificate_of_organisation' => $certificatePath ?? $organisation->certificate_of_organisation,
                'organisation_code' => $data['organisation_code']
            ]);

            DB::commit();

            return redirect()->route('organisation')->with('success', 'Organisation updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ERROR UPDATING Organisation');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred while updating organisation');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        try {
            $organisation = Organisation::findOrfail($id);

            if (!$organisation) {
                return redirect()->back()->with('error', 'Organisation not found');
            }

            $user = User::find($organisation->user_id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            DB::beginTransaction();

            $organisation->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('organisation')->with('success', 'Organisation deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ERROR DELETING Organisation');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred while deleting organisation');
        }
    }

    public function activateForm(string $id) {
        $organisation = Organisation::findOrfail($id);
        return view('organisation.activate',compact('organisation'));
    }

    public function activate ($id) {
        try {

            $organisation = Organisation::findOrfail($id);

            if (!$organisation) {
                return redirect()->back()->with('error', 'Organisation not found');
            }

            if ($organisation->status == 'active') {
                return redirect()->back()->with('error', 'Organisation is already active');
            }

            if (!$organisation->certificate_of_organisation) {
                return redirect()->back()->with('error', 'Missing Documents');
            }

            DB::beginTransaction();

            $organisation->update([
                'status' => 'active'
            ]);

            DB::commit();

            return redirect()->route('organisation')->with('success', 'Organisation activated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ERROR ACTIVATING Organisation');
            Log::error($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
}