@extends('layouts.app')

@section('title', 'Vehicles')
@section('content')

<div class="body-content">
    <div class="tile">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">Vehicles list</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <a class="btn btn-success" href="javascript:void(0);" onclick="axiosModal('admin/driver/create')">
                                <i class="fa fa-plus"></i>&nbsp;
                                Add driver
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
                                    <th title="Name">Make</th>
                                    <th title="Type">Model</th>
                                    <th title="Type">Plate Number</th>
                                    <th title="Action" width="80">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->plate_number }}</td>
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