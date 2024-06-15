<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TripInvoiceController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tripInvoice = Invoice::all();

            Log::info('All Trips Made from the Api :' . $tripInvoice);


            return response()->json([
                'Trip Invoice' => $tripInvoice
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING tripInvoice');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching tripInvoice',
                'error' => $e->getMessage()
            ], 500);
        }

        // $tripInvoice = Invoice::all();
        // return response()->json($tripInvoice);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'customer_id' => 'required|exists:customers,id',
            'invoice_no' => 'required|string',
            'customer_tin' => 'required|string',
            'customer_name' => 'required|string',
            'receipt_type_code' => 'required|string',
            'payment_type_code' => 'required|string',
            'sales_status_code' => 'required|string',
            'confirm_date' => 'required|date',
            'sales_date' => 'required|date',
            'cancel_request_date' => 'nullable|date',
            'refund_reason_code' => 'nullable|string',
            'total_taxable_amount' => 'required|numeric',
            'total_tax_amount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'remark' => 'required|string',
        ]);

        // Generate QR code URL
        $qrCodeUrl = $this->generateQrCode($validatedData);

        // Add QR code URL to validated data
        $validatedData['qr_code_url'] = $qrCodeUrl;

        // Create trip invoice
        $tripInvoice = Invoice::create($validatedData);

        return response()->json(['trip_invoice' => $tripInvoice], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the trip invoice by ID
        $tripInvoice = Invoice::findOrFail($id);
        return response()->json(['trip_invoice' => $tripInvoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the trip invoice by ID
        $tripInvoice = Invoice::findOrFail($id);

        // Validate request data
        $validatedData = $request->validate([
            'trip_id' => 'sometimes|required|exists:trips,id',
            'customer_id' => 'sometimes|required|exists:customers,id',
            'invoice_no' => 'sometimes|required|string',
            'customer_tin' => 'sometimes|required|string',
            'customer_name' => 'sometimes|required|string',
            'receipt_type_code' => 'sometimes|required|string',
            'payment_type_code' => 'sometimes|required|string',
            'sales_status_code' => 'sometimes|required|string',
            'confirm_date' => 'sometimes|required|date',
            'sales_date' => 'sometimes|required|date',
            'cancel_request_date' => 'sometimes|nullable|date',
            'refund_reason_code' => 'sometimes|nullable|string',
            'total_taxable_amount' => 'sometimes|required|numeric',
            'total_tax_amount' => 'sometimes|required|numeric',
            'total_amount' => 'sometimes|required|numeric',
            'remark' => 'sometimes|required|string',
        ]);

        // Update trip invoice
        $tripInvoice->update($validatedData);

        return response()->json(['trip_invoice' => $tripInvoice]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the trip invoice by ID and delete it
        $tripInvoice = Invoice::findOrFail($id);
        $tripInvoice->delete();

        return response()->json(['message' => 'Trip invoice deleted successfully']);
    }

    /**
     * Generate QR code URL and store the QR code image.
     */
    private function generateQrCode(array $data): string
    {
        $qrCodeContent = json_encode($data);

        // Generate QR code
        $qrCode = QrCode::generate($qrCodeContent);

        // Store QR code image
        $fileName = 'qr_codes/' . uniqid('qr_code_') . '.png';
        Storage::disk('public')->put($fileName, $qrCode);

        // Return the file path or URL
        return Storage::url($fileName);
    }

}