<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetroBerryAccounts;
use Illuminate\Support\Facades\Log;

class AccountingSettingController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        try {
            $settings = MetroBerryAccounts::all();
            return view('accounting-setting.index', compact('settings'));
        } catch (\Exception $e) {
            Log::error('Error fetching accounting settings: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the accounting settings.');
        }
    }

    // Show the form for creating a new resource
    public function create()
    {
        try {
            return view('accounting-setting.create');
        } catch (\Exception $e) {
            Log::error('Error displaying create form: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while displaying the create form.');
        }
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        try {

            $data = $request->all();
            $creator = Auth::user();

            $validator = Validator::make($data, [
                'holder_name' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'opening_balance' => 'required|numeric',
                'contact_number' => 'required|string|max:20',
                'bank_address' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::info('VALIDATION ERROR');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            // Create a new MetroBerry account record
            MetroBerryAccounts::create($request->all());

            // Redirect to the index page with success message
            return redirect()->route('account-setting.index')
                ->with('success', 'Accounting setting created successfully.');
        } catch (\Exception $e) {
            // Log any errors that occur during the process
            Log::error('Error storing accounting setting: ' . $e->getMessage());

            // Redirect back with an error message if an exception is caught
            return back()->with('error', 'An error occurred while creating the accounting setting.');
        }
    }


    // Show the form for editing the specified resource
    public function edit($id)
    {
        try {
            $setting = MetroBerryAccounts::findOrFail($id);
            return view('accounting-setting.edit', compact('setting'));
        } catch (\Exception $e) {
            Log::error('Error fetching accounting setting for edit: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the accounting setting for editing.');
        }
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'value' => 'required|string|max:255',
            ]);

            $setting = MetroBerryAccounts::findOrFail($id);
            $setting->update($request->all());

            return redirect()->route('account-setting.index')
                ->with('success', 'Accounting setting updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating accounting setting: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the accounting setting.');
        }
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        try {
            $setting = MetroBerryAccounts::findOrFail($id);
            $setting->delete();

            return redirect()->route('account-setting.index')
                ->with('success', 'Accounting setting deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting accounting setting: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the accounting setting.');
        }
    }
}