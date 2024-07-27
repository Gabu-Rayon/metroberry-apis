<div class="table-responsive">
    <table class="table" id="driver-table">
        <thead>
            <tr>
                <th title="Name">Vehicle</th>
                <th title="Type">Insurance Company</th>
                <th title="Type">Policy Number</th>
                <th title="Type">Charges</th>
                <th title="Type">Status</th>
                <th title="Nid">Issue Date</th>
                <th title="Nid">Expiry Date</th>
                <th title="Action" width="80">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicleInsurances as $insurance)
                <tr>
                    <td>{{ $insurance->vehicle->model }}<br>({{ $insurance->vehicle->plate_number }})
                    </td>
                    <td>{{ $insurance->insuranceCompany->name }}</td>
                    <td>{{ $insurance->insurance_policy_no }}</td>
                    <td>kes.{{ $insurance->charges_payable }}</td>
                    <td>
                        @if ($insurance->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $insurance->insurance_date_of_issue }}</td>
                    <td>{{ $insurance->insurance_date_of_expiry }}</td>
                    <td class="d-flex">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                            onclick="axiosModal('/vehicle/insurance/{{ $insurance->id }}/edit')">
                            <i class="fas fa-edit"></i>
                        </a>
                        <span class="m-1"></span>
                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                            onclick="axiosModal('/vehicle/insurance/{{ $insurance->id }}/')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>