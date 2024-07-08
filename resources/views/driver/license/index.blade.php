@extends('layouts.app')

@section('title', 'Licenses')
@section('content')

<div class="body-content">
    <div class="tile">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">Driver list</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <a class="btn btn-success" href="javascript:void(0);" onclick="axiosModal('admin/driver/create')">
                                <i class="fa fa-plus"></i>&nbsp;
                                Add License
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
                                    <th title="Name">Driver</th>
                                    <th title="Type">License No</th>
                                    <th title="Type">License Issue</th>
                                    <th title="Nid">License Expiry</th>
                                    <th title="Action" width="80">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($licenses as $license)
                                <tr>
                                    <td>{{$license->driver->user->name}}</td>
                                    <td>{{$license->driving_license_no}}</td>
                                    <td>{{$license->driving_license_date_of_issue}}</td>
                                    <td>{{$license->driving_license_date_of_expiry}}</td>
                                    <td></td>
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