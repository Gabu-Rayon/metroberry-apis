<?php

namespace App\Exports;

use App\Models\DriversLicenses;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DriversLicensesExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return DriversLicenses::query()
            ->join('drivers', 'drivers_licenses.driver_id', '=', 'drivers.id')
            ->join('users', 'drivers.user_id', '=', 'users.id')
            ->select(
                'users.name as driver_name',
                'drivers_licenses.driving_license_no',
                'drivers_licenses.driving_license_date_of_issue',
                'drivers_licenses.driving_license_date_of_expiry',
                'drivers_licenses.driving_license_avatar_front',
                'drivers_licenses.driving_license_avatar_back',
                'drivers_licenses.verified',
                'drivers_licenses.created_at',
                'drivers_licenses.updated_at',
            );
    }

    public function headings(): array
    {
        return [
            'ID',
            'Driver ID',
            'Driving License No',
            'Date of Issue',
            'Date of Expiry',
            'Avatar Front',
            'Avatar Back',
            'Verified',
            'Created At',
            'Updated At',
            'Driver Name', // Add this header to match the 'users.name as driver_name' column
        ];
    }
}
