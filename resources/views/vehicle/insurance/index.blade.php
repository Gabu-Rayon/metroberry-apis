@extends('layouts.app')

@section('title', 'Insurances')
@section('content')

<div class="body-content">
    <div class="tile">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">Insurances</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <a class="btn btn-success" href="javascript:void(0);" onclick="axiosModal('admin/driver/create')">
                                <i class="fa fa-plus"></i>&nbsp;
                                Add Insurance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive">
                        <table class="table" id="driver-table">
                            <thead>
                                <tr>
                                    <th title="Name">Vehicle</th>
                                    <th title="Type">Insurance Company</th>
                                    <th title="Type">Policy Number</th>
                                    <th title="Nid">Issue Date</th>
                                    <th title="Nid">Expiry Date</th>
                                    <th title="Action" width="80">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($insurances as $insurance)
                                <tr>
                                    <td>{{$insurance->vehicle->make}} {{ $insurance->vehicle->model }}</td>
                                    <td>{{$insurance->insurance_company}}</td>
                                    <td>{{$insurance->insurance_policy_no}}</td>
                                    <td>{{$insurance->insurance_date_of_issue}}</td>
                                    <td>{{$insurance->insurance_date_of_expiry}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection