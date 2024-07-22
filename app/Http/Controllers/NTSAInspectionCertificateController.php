<?php

namespace App\Http\Controllers;

use App\Models\NTSAInspectionCertificate;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NTSAInspectionCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $certificates = NTSAInspectionCertificate::all();
        Log::info('INSPECTION CERTIFICATES');
        Log::info($certificates);
        return view('vehicle.inspection-certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $vehicles = Vehicle::doesntHave('inspectionCertificates')->get();
        return view('vehicle.inspection-certificates.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle' => 'required|exists:vehicles,id',
                'ntsa_inspection_certificate_date_of_issue' => 'required|date',
                'ntsa_inspection_certificate_no' => 'required|string|unique:ntsa_inspection_certificates,ntsa_inspection_certificate_no',
                'ntsa_inspection_certificate_date_of_expiry' => 'required|date',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            $avatarPath = null;
            $certNo = $data['ntsa_inspection_certificate_no'];

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $avatarExtension = $avatarFile->getClientOriginalExtension();
                $avatarFileName = "{$certNo}-avatar.{$avatarExtension}";
                $avatarPath = $avatarFile->storeAs('uploads/ntsa-insp-cert-copies', $avatarFileName, 'public');
            }

            NTSAInspectionCertificate::create([
                'vehicle_id' => $data['vehicle'],
                'creator_id' => auth()->id(),
                'ntsa_inspection_certificate_no' => $certNo,
                'ntsa_inspection_certificate_date_of_issue' => $data['ntsa_inspection_certificate_date_of_issue'],
                'ntsa_inspection_certificate_date_of_expiry' => $data['ntsa_inspection_certificate_date_of_expiry'],
                'ntsa_inspection_certificate_avatar' => $avatarPath,
            ]);

            DB::commit();

            return redirect()->route('vehicle.inspection.certificate')->with('success', 'Inspection Certificate added successfully.');
        } catch (Exception $e) {
            Log::error('STORE INSPECTION CERTIFICATE ERROR');
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NTSAInspectionCertificate $nTSAInspectionCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $vehicles = Vehicle::all();
        $certificate = NTSAInspectionCertificate::find($id);
        return view('vehicle.inspection-certificates.edit', compact('certificate', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle' => 'required|exists:vehicles,id',
                'ntsa_inspection_certificate_date_of_issue' => 'required|date',
                'ntsa_inspection_certificate_no' => 'required|string|unique:ntsa_inspection_certificates,ntsa_inspection_certificate_no,'.$id,
                'ntsa_inspection_certificate_date_of_expiry' => 'required|date',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            $certificate = NTSAInspectionCertificate::find($id);

            $avatarPath = $certificate->ntsa_inspection_certificate_avatar;
            $certNo = $data['ntsa_inspection_certificate_no'];

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $avatarExtension = $avatarFile->getClientOriginalExtension();
                $avatarFileName = "{$certNo}-avatar.{$avatarExtension}";
                $avatarPath = $avatarFile->storeAs('uploads/ntsa-insp-cert-copies', $avatarFileName, 'public');
            }

            $certificate->update([
                'vehicle_id' => $data['vehicle'],
                'creator_id' => auth()->id(),
                'ntsa_inspection_certificate_no' => $certNo,
                'ntsa_inspection_certificate_date_of_issue' => $data['ntsa_inspection_certificate_date_of_issue'],
                'ntsa_inspection_certificate_date_of_expiry' => $data['ntsa_inspection_certificate_date_of_expiry'],
                'ntsa_inspection_certificate_avatar' => $avatarPath,
                'verified' => false,
            ]);

            $certificate->save();

            DB::commit();

            return redirect()->route('vehicle.inspection.certificate')->with('success', 'Inspection Certificate updated successfully.');
        } catch (Exception $e) {
            Log::error('UPDATE INSPECTION CERTIFICATE ERROR');
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function verifyForm($id) {
        $certificate = NTSAInspectionCertificate::find($id);
        return view('vehicle.inspection-certificates.verify', compact('certificate'));
    }

    public function verify($id) {
        try {
            $certificate = NTSAInspectionCertificate::findOrFail($id);
            $expired = strtotime($certificate->ntsa_inspection_certificate_date_of_expiry) < strtotime(date('Y-m-d'));

            if ($expired) {
                return back()->with('error', 'Inspection Certificate has expired.');
            }

            if ($certificate->verified) {
                return back()->with('error', 'Inspection Certificate already verified.');
            }

            DB::beginTransaction();

            $certificate->update([
                'verified' => true,
            ]);

            $certificate->save();

            DB::commit();

            return redirect()->route('vehicle.inspection.certificate')->with('success', 'Inspection Certificate verified successfully.');            
        } catch (Exception $e) {
            Log::error('VERIFY INSPECTION CERTIFICATE ERROR');
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function suspendForm($id) {
        $certificate = NTSAInspectionCertificate::find($id);
        return view('vehicle.inspection-certificates.suspend', compact('certificate'));
    }

    public function suspend($id) {
        try {
            $certificate = NTSAInspectionCertificate::findOrFail($id);

            if (!$certificate->verified) {
                return back()->with('error', 'Inspection Certificate already suspended.');
            }

            DB::beginTransaction();

            $certificate->update([
                'verified' => false,
            ]);

            $certificate->save();

            DB::commit();

            return redirect()->route('vehicle.inspection.certificate')->with('success', 'Inspection Certificate suspended successfully.');            
        } catch (Exception $e) {
            Log::error('SUSPEND INSPECTION CERTIFICATE ERROR');
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete($id){
        $certificate = NTSAInspectionCertificate::find($id);
        return view('vehicle.inspection-certificates.delete', compact('certificate'));
    }
    
    public function destroy($id){
        try {
            $certificate = NTSAInspectionCertificate::findOrfail($id);
            
            DB::beginTransaction();

            $certificate->delete();

            DB::commit();

            return redirect()->route('vehicle.inspection.certificate')->with('success', 'Inspection Certificate deleted successfully.');
        } catch (Exception $e) {
            Log::error('DELETE INSPECTION CERTIFICATE ERROR');
            Log::error($e);
            return back()->with('error', 'Something went wrong.');
        }
    }
}
