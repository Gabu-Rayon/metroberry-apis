<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\PSVBadge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PSVBadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $psvbadges = PSVBadge::all();
        return view('driver.psvbadge.index', compact('psvbadges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $drivers = Driver::whereDoesntHave('psvBadge')->get();
        return view('driver.psvbadge.create', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'driver' => 'required|numeric|exists:drivers,id',
                'psvbadge_no' => 'required|unique:psv_badges,psv_badge_no',
                'issue_date' => 'required|date',
                'expiry_date' => 'required|date|after:issue_date',
                'psv_badge_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                Log::error('PSV BADGE STORE VALIDATION ERROR');
                Log::error($validator->errors()->all());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $badgePath = null;
            $badgeNumber = $data['psvbadge_no'];

            DB::beginTransaction();
            
            if ($request->hasFile('psv_badge_avatar')) {
                $badgeFile = $request->file('psv_badge_avatar');
                $badgeExtension = $badgeFile->getClientOriginalExtension();
                $badgeFileName = "{$badgeNumber}-back-id.{$badgeExtension}";
                $badgePath = $badgeFile->storeAs('uploads/psvbadge-avatars', $badgeFileName, 'public');
            }

            PSVBadge::create([
                'driver_id' => $data['driver'],
                'psv_badge_no' => $badgeNumber,
                'psv_badge_date_of_issue' => $data['issue_date'],
                'psv_badge_date_of_expiry' => $data['expiry_date'],
                'psv_badge_avatar' => $badgePath,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'PSV Badge Created Successfully');

        } catch (Exception $e) {
            Log::error('PSV BADGE STORE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PSVBadge $pSVBadge)
    {
        //
    }
}
