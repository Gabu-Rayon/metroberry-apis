@extends('layouts.app')

@section('title', 'Vehicle List')
@section('content')

    <body class="fixed sidebar-mini">

        @include('components.preloader')
        <!-- react page -->
        <div id="app">
            <!-- Begin page -->
            <div class="wrapper">
                <!-- start header -->
                @include('components.sidebar.sidebar')
                <!-- end header -->
                <div class="content-wrapper">
                    <div class="main-content">
                        @include('components.navbar')

                        <div class="body-content">
                            <div class="tile">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-17 fw-semi-bold mb-0">Vehicle list</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('vehicle/create')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Add vehicle
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
                                                            <th title="Driver">Driver</th>
                                                            <th title="Make">Make</th>
                                                            <th title="Model">Model</th>
                                                            <th title="Plate Number">Plate Number</th>
                                                            <th title="Seats">Seats</th>
                                                            <th title="Fuel Type">Fuel Type</th>
                                                            <th title="Engine Size (CC)">Engine Size (CC)</th>
                                                            <th title="Status">Status</th>
                                                            <th title="Action" width="150">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($vehicles as $vehicle)
                                                            <tr>
                                                                <td>
                                                                @if ($vehicle->driver && $vehicle->driver->user)
                                                                    {{ $vehicle->driver->user->name }}
                                                                @else
                                                                 @if (\Auth::user()->can('assign vehicle'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-primary"
                                                                        onclick="axiosModal('/vehicle/{{ $vehicle->id }}/assign/driver')">
                                                                        Assign Driver
                                                                    </a>
                                                                    @endif
                                                                @endif
                                                                </td>
                                                                <td>{{ $vehicle->make }}</td>
                                                                <td>{{ $vehicle->model }}</td>
                                                                <td>{{ $vehicle->plate_number }}</td>
                                                                <td>{{ $vehicle->seats }}</td>
                                                                <td>{{ $vehicle->fuel_type }}
                                                                </td>
                                                                <td>{{ $vehicle->engine_size }}<i>CC</i></td>
                                                                <td>
                                                                    @if ($vehicle->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                        @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                         @if (\Auth::user()->can('edit vehicle'))
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('/vehicle/{{ $vehicle->id }}/edit')" title="Edit Driver">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endif
                                                        <span class='m-1'></span>
                                                        @if ($vehicle->status == 'active')
                                                        @if (\Auth::user()->can('deactivate vehicle'))
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="axiosModal('/vehicle/{{ $vehicle->id }}/deactivate')" title="Dectivate Driver">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </a> 
                                                            @endif
                                                        @else
                                                            @if (\Auth::user()->can('activate vehicle'))
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary" onclick="axiosModal('/vehicle/{{ $vehicle->id }}/activate')" title="Activate Driver">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>  
                                                            @endif                                                      
                                                        @endif
                                                        <span class='m-1'></span>
                                                         @if (\Auth::user()->can('delete vehicle'))
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="axiosModal('vehicle/{{ $vehicle->id }}/delete')" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>


                                            <div id="page-axios-data" data-table-id="#driver-table"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
            <!--end  vue page -->
        </div>
        <!-- END layout-wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="delete-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form">
                            <div class="modal-body">
                                <p>Are you sure you want to delete this item? you won t be able to revert this item back!
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-danger" type="submit" id="delete_submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
