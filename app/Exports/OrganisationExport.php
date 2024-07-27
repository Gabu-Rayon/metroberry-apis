<?php

namespace App\Exports;

use App\Models\Organisation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrganisationExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Organisation::query()
            ->join('users', 'organisations.user_id', '=', 'users.id')
            ->select(
                'users.name as Name',
                'users.email as Email',
                'users.phone as Phone',
                'users.address as Address',
                'organisations.organisation_code as Organisation',
                'organisations.status as Status'
            );
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Address',
            'Organisation',
            'Status'
        ];
    }
}