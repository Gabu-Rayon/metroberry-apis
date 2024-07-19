<?php
namespace App\Exports;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $users = User::where('role', 'customer')->get();
        $exportData = [];

        foreach ($users as $user) {
            $customer = Customer::where('user_id', $user->id)->first();

            if ($customer) {
                $exportData[] = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'customer_organisation_code' => $customer->customer_organisation_code,
                    'national_id_no' => $customer->national_id_no,
                ];
            }
        }

        return collect($exportData);
    }

    public function headings(): array
    {
        return [
            "Name",
            "Email",
            "Phone Contact",
            "Address",
            "Customer Organisation Code",
            "National ID",
        ];
    }
}