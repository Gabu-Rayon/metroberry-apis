<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Vehicle;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\MaintenanceService;
use App\Models\MetroBerryAccounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\MaintenanceServicePayment;
use Illuminate\Support\Facades\Validator;

class MaintenanceServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $maintenanceServices = MaintenanceService::with('vehicle', 'creator')->get();
        return view('vehicle.maintenance-services.index', compact('maintenanceServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $vehicles = Vehicle::all();
        $serviceTypes = ServiceType::all();
        return view('vehicle.maintenance-services.create', compact('vehicles', 'serviceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'vehicle' => 'required|numeric|exists:vehicles,id',
                'service_type_id' => 'required|numeric|exists:service_types,id',
                'service_date' => 'required|date',
                'service_description' => 'required|string|max:255',
                'service_category_id' => 'required|numeric|exists:service_type_categories,id',
                'service_cost' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR');
                Log::error($validator->errors());
                return redirect()->back()->with('error', 'Validation error');
            }
            
            DB::beginTransaction();

            MaintenanceService::create([
                'vehicle_id' => $data['vehicle'],
                'creator_id' => auth()->id(),
                'service_type_id' => $data['service_type_id'],
                'service_category_id' => $data['service_category_id'],
                'service_date' => $data['service_date'],
                'service_cost' => $data['service_cost'],
                'service_description' => $data['service_description'],
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('STORE MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceService $maintenanceService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceService $maintenanceService)
    {
        //
    }

    public function approveForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.approve', compact('service'));
    }

    public function approve($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'approved'
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service approved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('APPROVE MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function rejectForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.reject', compact('service'));
    }

    public function reject($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'rejected',
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service rejected successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('REJECT MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function billForm($id) {
        $service = MaintenanceService::findOrFail($id);
        return view('vehicle.maintenance-services.bill', compact('service'));
    }

    public function bill($id) {
        try {
            $service = MaintenanceService::findOrFail($id);

            DB::beginTransaction();

            $service->update([
                'service_status' => 'billed',
            ]);

            DB::commit();

            return redirect()->route('maintenance.service')->with('success', 'Maintenance service billed successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('BILL MAINTENANCE SERVICE ERROR');
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceService $maintenanceService)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceService $maintenanceService)
    {
        //
    }




    public function maintenanceServicePaymentCheckOut($id)
    {
        try {
            // Fetch the trip details where the status is 'billed' or 'partially paid',' paid'
            $maintenanceService = MaintenanceService::where('id', $id)
                ->whereIn('status', ['billed', 'paid', 'partially paid'])
                ->firstOrFail();

            // Retrieve all payments for this trip
            // $ThisMaintenanceServicePayment = MaintenanceServicePayment::where('trip_id', $id)->get();
            $ThisMaintenanceServicePayment = MaintenanceServicePayment::where('trip_id', $id)->with('account')->get();

            Log::info('This Maintenance Service payments data: ', $ThisMaintenanceServicePayment->toArray());

            // Calculate the total paid amount from the MaintenanceServicePayment table
            $totalPaid = MaintenanceServicepayment::where('trip_id', $id)->sum('total_amount');

            // Calculate the remaining amount to be paid
            $remainingAmount = $maintenanceService->total_price - $totalPaid;

            // Return the view with the trip details and remaining amount
            return view('maintenance-services.serviceCheckout.vehicle-service-checkout', compact('maintenanceService', 'remainingAmount', 'ThisTripPayments'));

        } catch (Exception $e) {
            Log::error('Error fetching trip details for payment checkout: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the trip details. Please try again.');
        }
    }


    /**
     * Receive payment for a billed trip.
     */
    public function billedVehicleServiceMaintenanceRecievePayment($id)
    {
        try {
            Log::info('billed Vehicle Service Maintenance to receive Payment');
            Log::info($id);

            // Fetch the MaintenanceService details where the status is 'billed' or 'partially paid'
            $maintenanceService = MaintenanceService::where('id', $id)
                ->whereIn('status', ['billed', 'partially paid'])
                ->firstOrFail();

            // Calculate the total paid amount
            $totalPaid = MaintenanceServicePayment::where('trip_id', $id)->sum('total_amount');

            // Calculate the remaining amount
            $remainingAmount = $maintenanceService->total_price - $totalPaid;

            // Fetch all accounts
            $accounts = MetroBerryAccounts::all();

            // Pass the necessary data to the view
            return view('vehicle.service.vehicle-service-receive-payment', compact('maintenanceService', 'remainingAmount', 'accounts'));
        } catch (\Exception $e) {
            Log::error('Error receiving payment for Vehicle Service Maintenance: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while receiving the payment For Vehicle Service Maintenance. Please try again.');
        }
    }



    public function billedVehicleServiceMaintenanceRecievePaymentStore(Request $request, $id)
    {
        try {
            $data = $request->all();

            Log::info('data from the Form  receive payment of billed trip');
            Log::info($data);

            $creator = Auth::user();

            Log::info('User Mwenye anaweka ndoo ya trip');

            Log::info($creator);
            // Validation rules
            $validator = Validator::make($data, [
                'payment_date' => 'required|date',
                'amount' => 'required|numeric',
                'account_id' => 'required|string',
                'remark' => 'nullable|string',
                'payment_receipt' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx',
                'reference' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::info('VALIDATION ERROR');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            $invoiceNo = $this->generateInvoiceNumber();
            Log::info('Invoice Generated No.');
            Log::info($invoiceNo);

            // Retrieve tripdetails based on $id
            $trip = Trip::findOrFail($id);

            $tripPayment = new MaintenanceServicePayment();
            $tripPayment->trip_id = $trip->id;
            $tripPayment->customer_id = $trip->customer_id;
            $tripPayment->invoice_no = $invoiceNo;
            $tripPayment->account_id = $data['account_id'];
            $tripPayment->customer_tin = $trip->customer->user->customer_tin;
            $tripPayment->customer_name = $trip->customer->user->name;
            $tripPayment->receipt_type_code = null;
            $tripPayment->payment_type_code = null;
            $tripPayment->confirm_date = null;
            $tripPayment->payment_date = $data['payment_date'];
            $tripPayment->total_taxable_amount = $trip->total_price;
            $tripPayment->total_tax_amount = null;
            $tripPayment->total_amount = $data['amount'];
            $tripPayment->remark = $data['remark'];
            $tripPayment->payment_receipt = $data['payment_receipt'];
            $tripPayment->reference = $data['reference'];
            $tripPayment->qr_code_url = null;
            $tripPayment->created_by = $creator->id;

            // Handle payment receipt file upload
            if ($request->hasFile('payment_receipt')) {
                $file = $request->file('payment_receipt');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('payment_receipts'), $fileName);
                $tripPayment->payment_receipt = $fileName;
            }

            $tripPayment->save();
            Log::info('Trip Payment Saved');

            if ($data['amount'] >= $trip->total_price) {
                $trip->status = 'paid';
            } else {
                $trip->status = 'partially paid';
            }
            $trip->save();

            return redirect()->route('trip.payment.checkout', ['id' => $id])
                ->with('success', 'Payment received && Added successfully.');
        } catch (\Exception $e) {
            Log::error('Error receiving payment for trip: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while receiving the payment. Please try again.');
        }
    }

    /**
     * Generate a unique invoice number.
     *
     * @return string
     */
    private function generateInvoiceNumber()
    {
        // Example: "MB-INV001", "MB-INV002", etc.
        $latestPayment = MaintenanceServicePayment::latest()->first();
        $latestInvoiceNumber = $latestPayment ? $latestPayment->id + 1 : 1;
        return 'MB-INV' . str_pad($latestInvoiceNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Download TripPayment for a billed trip.
     */
    public function billedVehicleServiceMaintenanceDownloadInvoice($id)
    {
        try {
            // Fetch the trip details where the status is 'billed'
            $maintenanceService = MaintenanceService::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to generate and download the TripPayment
            //Now to download will call a template pass all the data for this invoice to
            //  the template the download it  in a pdf  
            // the template  is in tripInvoiceTemplate.metro-berry-trip-invoice-template 

            // return response()->download($TripPaymentPath);
        } catch (\Exception $e) {
            Log::error('Error downloading TripPayment for trip: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while downloading the TripPayment. Please try again.');
        }
    }

    /**
     * Resend TripPayment for a billed trip.
     */
    public function billedVehicleServiceMaintenanceResendInvoice($id)
    {
        try {
            // Fetch the trip details where the status is 'billed'
            $maintenanceServicePayment = MaintenanceServicePayment::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to resend the TripPayment
            // For example, send the TripPayment via email
            // Mail::to($trip->customer->email)->send(new TripTripPaymentMail($trip));

            return back()->with('success', 'TripPayment resent successfully.');
        } catch (\Exception $e) {
            Log::error('Error resending TripPayment for trip: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while resending the TripPayment. Please try again.');
        }
    }

    /**
     * Send TripPayment for a billed trip.
     */
    public function billedVehicleServiceMaintenanceSendInvoice($id)
    {
        try {
            // Fetch the trip details where the status is 'billed'
            $maintenanceService = MaintenanceService::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to send the TripPayment
            // For example, send the TripPayment via email
            // Mail::to($trip->customer->email)->send(new TripTripPaymentMail($trip));

            return back()->with('success', 'TripPayment sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending TripPayment for trip: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending the TripPayment. Please try again.');
        }
    }
}