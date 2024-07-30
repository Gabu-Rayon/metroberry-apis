<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{

    public function __construct()
    {

    }

    public function collection()
    {
        // get the name and organisa$employees = Customer::with('user')->get();

        // Process the data
        $employees = Customer::with('user')->get();
        $formattedEmployees = $employees->map(function($customer) {
            return [
                'name' => $customer->user->name, // Access related user's name
                'organisation' => $customer->customer_organisation_code // Access customer's own fields
            ];
        });
        return $formattedEmployees;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Organisation'
        ];
    }
}
