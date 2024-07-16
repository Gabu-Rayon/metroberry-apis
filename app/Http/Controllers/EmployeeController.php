<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Customer;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the authenticated user has the 'view customers' permission
        if (\Auth::user()->can('view customers')) {
            try {
                $customers = null;

                // Check the user's role
                if (Auth::user()->role == 'admin') {
                    // If the user is an admin, fetch all customers
                    $customers = Customer::all();
                } elseif (Auth::user()->role == 'organisation') {
                    // If the user is an organisation, fetch customers for that organisation
                    $organisation = Organisation::where('user_id', Auth::user()->id)->first();
                    if ($organisation) {
                        $customers = Customer::where('customer_organisation_code', $organisation->organisation_code)->get();
                    }
                } else {
                    // If the user has another role, fetch customers created by the user
                    $customers = Customer::where('created_by', Auth::user()->id)->get();
                }

                Log::info('Customers fetched: ', ['customers' => $customers]);

                // Fetch organisations with user information
                $organisations = Organisation::with('user')->get();

                return view('employee.index', compact('customers', 'organisations'));
            } catch (Exception $e) {
                // Log the error message
                Log::error('Error fetching customers: ' . $e->getMessage());

                return back()->with('error', 'An error occurred while fetching the customers. Please try again.');
            }
        } else {
            return back()->with('error', 'Permission Denied.');
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $data = $request->all();
            $creator = Auth::user();
            
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
                Log::info('VALIDATION ERROR');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
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
                'created_by' => $creator->id,
                'role' => 'customer',
            ]);

            $user->assignRole('customer');

            Customer::create([
                'created_by' => $creator->id,
                'user_id' => $user->id,
                'organisation_id' => $organisation->id,
                'customer_organisation_code' => $data['organisation'],
                'national_id_no' => $data['national_id'],
                'national_id_front_avatar' => $frontIdPath,
                'national_id_behind_avatar' => $backIdPath,
            ]);

            DB::commit();

            Log::info('SUCCESS');

            return redirect()->route('employee')->with('success', 'Customer created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CREATE CUSTOMER ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred')->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     try {
    //         // Retrieve the customer with the user and creator details
    //         $customer = Customer::with(['user', 'creator'])->findOrFail($id);

    //         // Prepare the response data
    //         $response = [
    //             'id' => $customer->id,
    //             'created_by' => [
    //                 'id' => $customer->creator->id,
    //                 'name' => $customer->creator->name,
    //                 'email' => $customer->creator->email
    //             ],
    //             'user' => [
    //                 'id' => $customer->user->id,
    //                 'name' => $customer->user->name,
    //                 'email' => $customer->user->email,
    //                 'phone' => $customer->user->phone
    //             ],
    //             'organisation_id' => $customer->organisation_id,
    //             'customer_organisation_code' => $customer->customer_organisation_code
    //         ];

    //         return response()->json([
    //             'message' => 'Customer retrieved successfully',
    //             'customer' => $response
    //         ], 200);
    //     } catch (Exception $e) {
    //         Log::error('RETRIEVE CUSTOMER ERROR');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred while fetching customer',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function show(string $id)
    {
        try {
            // Retrieve the customer with the user, creator, and organisation details
            $customer = Customer::with([
                'user',
                'creator',
                'organisation.user'
            ])->findOrFail($id);

            // Prepare the response data
            $response = [
                'id' => $customer->id,
                'created_by' => [
                    'id' => $customer->creator->id,
                    'name' => $customer->creator->name,
                    'email' => $customer->creator->email,
                    "phone" => $customer->creator->phone,
                    "address" => $customer->creator->address,
                    "avatar" => $customer->creator->avatar,
                    "organisation" => $customer->creator->organisation
                ],
                'user' => [
                    'id' => $customer->user->id,
                    'name' => $customer->user->name,
                    'email' => $customer->user->email,
                    "phone" => $customer->user->phone,
                    "address" => $customer->user->address,
                    "avatar" => $customer->user->avatar,
                    "organisation" => $customer->user->organisation
                ],
                'organisation' => [
                    'id' => $customer->organisation->id,
                    'name' => $customer->organisation->user->name,
                    "phone" => $customer->organisation->user->phone,
                    "address" => $customer->organisation->user->address,
                    "avatar" => $customer->organisation->user->avatar,
                    "organisation" => $customer->organisation->user->organisation
                ],
                'organisation_id' => $customer->organisation_id,
                'customer_organisation_code' => $customer->customer_organisation_code
            ];

            return response()->json([
                'message' => 'Customer retrieved successfully',
                'customer' => $response
            ], 200);
        } catch (Exception $e) {
            Log::error('RETRIEVE CUSTOMER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while fetching customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */


      public function create(){
        $organisations = Organisation::with('user')->where('status', 'active')->get();
        return view('employee.create', compact('organisations'));
      }

    public function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $organisations = Organisation::with('user')->get();
        return view('employee.edit', compact('customer', 'organisations'));
    }

    public function update(Request $request, $id)
    {
        try {

            $customer = Customer::find($id);
            $user = User::find($customer->user_id);
            $data = $request->all();
            $organisation = Organisation::where('organisation_code', $data['organisation'])->first();

            if (!$customer) {
                return redirect()->back()->with('error', 'Customer not found');
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
                'national_id_no' => 'required|string|unique:customers,national_id_no,' . $customer->id,
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
            $customer->national_id_no = $data['national_id_no'];

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
                $customer->national_id_front_avatar = $frontIdPath;
            }

            if ($request->hasFile('back_page_id')) {
                $backIdFile = $request->file('back_page_id');
                $backIdExtension = $backIdFile->getClientOriginalExtension();
                $backIdFileName = "{$email}-back-id.{$backIdExtension}";
                $backIdPath = $backIdFile->storeAs('uploads/back-page-ids', $backIdFileName, 'public');
                $customer->national_id_behind_avatar = $backIdPath;
            }

            $customer->save();
            $user->save();

            DB::commit();

            return redirect()->route('employee')->with('success', 'Customer updated successfully');


        }catch (Exception $e) {
            DB::rollBack();
            Log::info('UPDATE CUSTOMER ERROR');
            Log::info($e);
            return redirect()->back()->with('error', 'An error occurred while updating customer');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $customer = Customer::find($id);

            if (!$customer) {
                return redirect()->back()->with('error', 'Customer not found');
            }

            $user = User::find($customer->user_id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            DB::beginTransaction();

            $customer->delete();
            $user->delete();

            DB::commit();


            return redirect()->route('employee')->with('success', 'Customer deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info('DELETE CUSTOMER ERROR');
            Log::info($e);
            return redirect()->back()->with('error', 'An error occurred while deleting customer');
        }
    }

    public function activateForm ($id) {
        $customer = Customer::findOrFail($id);
        return view('employee.activate', compact('customer'));
    }

    public function activate ($id) {
        try {

            $customer = Customer::find($id);

            if (!$customer) {
                return redirect()->back()->with('error', 'Customer not found');
            }

            if (!$customer->national_id_front_avatar || !$customer->national_id_behind_avatar) {
                return redirect()->back()->with('error', 'Missing Documents');
            }

            if (!$customer->national_id_no) {
                return redirect()->back()->with('error', 'Missing National ID');
            }

            $user = User::find($customer->user_id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            DB::beginTransaction();

            $customer->status = 'active';

            $customer->save();

            DB::commit();

            return redirect()->route('employee')->with('success', 'Customer activated successfully');
        } catch (Exception $e) {
            Log::info('ACTIVATE CUSTOMER ERROR');
            Log::info($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
}