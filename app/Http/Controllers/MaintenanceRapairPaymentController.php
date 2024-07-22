<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRepair;
use App\Models\MetroBerryAccounts;
use Illuminate\Support\Facades\Log;
use App\Models\MaintenanceRepairPayment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MaintenanceRapairPaymentController extends Controller
{

    /**
     * Receive payment for a billed MaintenanceRepairPayment.
     */
    public function billedVehicleRepairMaintenanceRecievePayment($id)
    {
        try {
            Log::info('Vehicle Maintainance Repair to receive Payment');
            Log::info($id);

            // Fetch the Vehicle Maintainance Repair details where the status is 'billed' or 'partially paid'
            $service = MaintenanceRepair::where('id', $id)
                ->whereIn('service_status', ['billed', 'partially paid'])
                ->firstOrFail();

            // Calculate the total paid amount
            $totalPaid = MaintenanceRepairPayment::where('maintenance_service_id', $id)->sum('total_amount');

            // Calculate the remaining amount
            $remainingAmount = $service->service_cost - $totalPaid;

            // Fetch all accounts
            $accounts = MetroBerryAccounts::all();

            // Pass the necessary data to the view
            return view('vehicle.maintenance-repair.repairCheckout.vehicle-repair-receive-payment', compact('service', 'remainingAmount', 'accounts'));
        } catch (\Exception $e) {
            Log::error('Error receiving payment for Vehicle Maintainance: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while receiving the payment. Please try again.');
        }
    }



    public function billedVehicleRepairMaintenanceRecievePaymentStore(Request $request, $id)
    {
        try {
            $data = $request->all();

            Log::info('Data from the Form to receive payment of billed service');
            Log::info($data);

            $creator = Auth::user();

            Log::info('User who is processing the payment');
            Log::info($creator);

            // Validation rules
            $validator = Validator::make($data, [
                'payment_date' => 'required|date',
                'amount' => 'required|numeric',
                'account_id' => 'required|exists:accounts,id', // Assuming 'accounts' is the table name and 'id' is the primary key
                'remark' => 'nullable|string',
                'payment_receipt' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx|max:2048',
                'reference' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::info('Validation Error');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            $invoiceNo = $this->generateInvoiceNumber();
            Log::info('Generated Invoice Number');
            Log::info($invoiceNo);

            // Retrieve service details based on $id
            $service = MaintenanceRepair::findOrFail($id);

            $maintenanceServicePayment = new MaintenanceRepairPayment();
            $maintenanceServicePayment->maintenance_service_id = $service->id;
            $maintenanceServicePayment->vehicle_id = $service->vehicle_id;
            $maintenanceServicePayment->service_type_id = $service->service_type_id;
            $maintenanceServicePayment->service_category_id = $service->service_category_id;
            $maintenanceServicePayment->service_date = $service->service_date;
            $maintenanceServicePayment->service_cost = $service->service_cost;
            $maintenanceServicePayment->invoice_no = $invoiceNo;
            $maintenanceServicePayment->account_id = $data['account_id'];
            $maintenanceServicePayment->receipt_type_code = null;
            $maintenanceServicePayment->payment_type_code = null;
            $maintenanceServicePayment->confirm_date = null;
            $maintenanceServicePayment->payment_date = $data['payment_date'];
            $maintenanceServicePayment->total_taxable_amount = $service->service_cost; // Adjust as needed
            $maintenanceServicePayment->total_tax_amount = null; // Adjust as needed
            $maintenanceServicePayment->total_amount = $data['amount'];
            $maintenanceServicePayment->remark = $data['remark'];
            $maintenanceServicePayment->reference = $data['reference'];
            $maintenanceServicePayment->qr_code_url = null;
            $maintenanceServicePayment->created_by = $creator->id;

            // Handle payment receipt file upload
            if ($request->hasFile('payment_receipt')) {
                $file = $request->file('payment_receipt');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('maintenance_service_payment_receipts'), $fileName);
                $maintenanceServicePayment->payment_receipt = $fileName;
            }

            $maintenanceServicePayment->save();
            Log::info('Maintenance Service Payment Saved');

            // Update the MaintenanceService status
            $totalPaid = MaintenanceRepairPayment::where('maintenance_service_id', $service->id)->sum('total_amount');

            if ($totalPaid >= $service->service_cost) {
                $service->service_status = 'paid';
            } else {
                $service->service_status = 'partially paid';
            }
            $service->save();

            return redirect()->route('maintenance.service.payment.checkout', ['id' => $id])
                ->with('success', 'Payment received and added successfully.');
        } catch (\Exception $e) {
            Log::error('Error receiving payment for Maintenance Service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while receiving the payment for the Maintenance Service. Please try again.');
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
        $latestPayment = MaintenanceRepairPayment::latest()->first();
        $latestInvoiceNumber = $latestPayment ? $latestPayment->id + 1 : 1;
        return 'MB-INV' . str_pad($latestInvoiceNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Download MaintenanceRepairPayment for a billed MaintenanceRepairPayment.
     */
    public function billedVehicleRepairMaintenanceDownloadInvoice($id)
    {
        try {
            // Fetch the MaintenanceRepairPayment details where the status is 'billed'
            $service = MaintenanceRepair::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to generate and download the MaintenanceServicePayment
            //Now to download will call a template pass all the data for this invoice to
            //  the template the download it  in a pdf  
            // the template  is in MaintenanceServiceInvoiceTemplate.metro-berry-MaintenanceRepairPayment-invoice-template 

            // return response()->download($maintenanceServicePath);
        } catch (\Exception $e) {
            Log::error('Error downloading detials for vehicle Maintenance: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while downloading the vehicle Maintenance Billied Invoice. Please try again.');
        }
    }

    /**
     * Resend MaintenanceService  for a billed MaintenanceService.
     */
    public function billedVehicleRepairMaintenanceResendInvoice($id)
    {
        try {
            // Fetch the MaintenanceRepair details where the status is 'billed'
            $service = MaintenanceRepair::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to send the Payment  For vehicle  MaintenanceService
            // For example, send the Payment via email
            // Mail::to($service->vendor->email)->send(new MaintenanceServicePaymentMail($service));

            return back()->with('success', 'Vehicle Maintenance Service Billed  resent successfully.');
        } catch (\Exception $e) {
            Log::error('Error resending Payment for Vehicle Maintenance Service Billed : ' . $e->getMessage());
            return back()->with('error', 'An error occurred while resending the MaintenanceRepairPayment. Please try again.');
        }
    }

    /**
     * Send Payment for a billed vehicle maintenance  Service.
     */
    public function billedVehicleRepairMaintenanceSendInvoice($id)
    {
        try {
            // Fetch the MaintenanceRepairPayment details where the status is 'billed'
            $service = MaintenanceRepair::where('id', $id)->where('status', 'billed')->firstOrFail();

            // Logic to send the Payment  For vehicle  MaintenanceService
            // For example, send the Payment via email
            // Mail::to($service->vendor->email)->send(new MaintenanceRepaiPÓaymentMail($service));

            return back()->with('success', 'Vehicle Maintenance Service Billed  sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending Payment for Vehicle Maintenance Service Billed : ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending the payment For Vehicle Maintenance Service Billed . Please try again.');
        }
    }


}