<?php

namespace App\Exports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DriverExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $role;
    protected $organisation;

    public function __construct($role, $organisation)
    {
        $this->role = $role;
        $this->organisation = $organisation;
    }


    public function query()
    {
        $query = Driver::query()
            ->join('users', 'drivers.user_id', '=', 'users.id')
            ->join('organisations', 'drivers.organisation_id', '=', 'organisations.id')
            ->select(
                'users.name as Name',
                'users.email as Email',
                'users.phone as Phone',
                'users.address as Address',
                'organisations.organisation_code as Organisation',
                'drivers.national_id_no as ID Number'
            );

        if ($this->role !== 'admin') {
            if ($this->organisation) {
                $query->where('organisations.organisation_code', $this->organisation->organisation_code);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }


    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Address',
            'Organisation',
            'ID Number'
        ];
    }
}
