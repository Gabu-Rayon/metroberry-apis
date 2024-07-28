<?php

namespace App\Exports;

use App\Models\Organisation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrganisationExport implements FromQuery, WithHeadings
{
    /**
     * Defines the query used to retrieve data for the export.
     *
     * @return \Illuminate\Database\Query\Builder
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

    /**
     * Defines the column headings for the exported file.
     *
     * @return array
     */
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