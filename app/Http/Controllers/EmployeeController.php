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
        // try {
        //     $customers = Customer::all();

        //     return response()->json([
        //         'message' => 'Customers retrieved successfully',
        //         'customers' => $customers
        //     ], 200);
        // } catch (Exception $e) {
        //     Log::info('RETRIEVE CUSTOMERS ERROR');
        //     Log::info($e);
        //     return response()->json([
        //         'message' => 'An error occurred while fetching customers',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

        $customers = Customer::with('user')->get();
        return view('employee', compact('customers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
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
                Log::info('VALIDATION ERROR');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            Log::info('DATA');
            Log::info($data);

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
            ]);

            Customer::create([
                'created_by' => 1,
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
        $organisations = Organisation::with('user')->get();
        return view('employee.create', compact('organisations'));
      }

    public function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        return view('employee.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found',
                ], 404);
            }

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            if ($customer->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'string',
                'avatar' => 'string',
            ]);

            $customer->user->name = $data['name'];
            $customer->user->email = $data['email'];
            $customer->user->phone = $data['phone'];
            $customer->user->address = $data['address'];
            $customer->user->avatar = $data['avatar'];
            $customer->user->save();

            return response()->json([
                'message' => 'Customer updated successfully',
                'customer' => $customer->user
            ], 200);
        } catch (Exception $e) {
            Log::info('UPDATE CUSTOMER ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while updating customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $customer = Customer::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found',
                ], 404);
            }

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            if ($customer->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            return response()->json([
                'message' => 'Customer deleted successfully',
                'customer' => $customer->user
            ], 200);
        } catch (Exception $e) {
            Log::info('DELETE CUSTOMER ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while deleting customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}