<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InsuranceCompanyController extends Controller
{

    public function index()
    {
        $insuranceCompanies = InsuranceCompany::all();
        return view('vehicle.insurance.company', compact('insuranceCompanies'));
    }
    public function create()
    {
        $insuranceCompanies = InsuranceCompany::all();
        return view('vehicle.insurance.company.create', compact('insuranceCompanies'));
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email',
                'address' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Create a new insurance company record
            $company = new InsuranceCompany();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->website = $request->website;
            $company->created_by = 1;
            $company->save();

            return redirect()->route('vehicle.insurance.company')->with('success', 'Insurance company added successfully.');
        } catch (Exception $e) {
            // Log the error message
            Log::error('Error storing insurance company: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while adding the insurance company. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $company = InsuranceCompany::findOrFail($id);

            return view('vehicle.insurance.company.edit', compact('company'));
        } catch (Exception $e) {
            Log::error('Error fetching insurance company for edit: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the insurance company. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email',
                'address' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Find the existing insurance company record
            $company = InsuranceCompany::findOrFail($id);

            // Update the insurance company record
            $company->name = $request->name;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->website = $request->website;
            $company->save();

            return redirect()->route('vehicle.insurance.company')->with('success', 'Insurance company updated successfully.');
        } catch (Exception $e) {
            // Log the error message
            Log::error('Error updating insurance company: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while updating the insurance company. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $company = InsuranceCompany::findOrFail($id);

            $company->delete();

            return redirect()->route('vehicle.insurance.company')->with('success', 'Insurance company deleted successfully.');
        } catch (Exception $e) {
            // Log the error message
            Log::error('Error deleting insurance company: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while deleting the insurance company. Please try again.');
        }
    }

}