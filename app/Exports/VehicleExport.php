<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehicleExport implements FromCollection
{

    public function __construct()
    {

    }

    public function collection()
    {

    }

    public function headings(): array
    {

    }
}