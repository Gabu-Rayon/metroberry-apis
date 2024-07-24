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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Vehicle list</h6>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#vehicleModal">
                                                    <i class="fa-solid fa-user-plus"></i>&nbsp; Add Vehicle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="driver-table">
                                                <thead>
                                                    <tr>
                                                        <th>Driver</th>
                                                        <th>Make</th>
                                                        <th>Model</th>
                                                        <th>Plate Number</th>
                                                        <th>Seats</th>
                                                        <th>Fuel Type</th>
                                                        <th>Engine Size (CC)</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
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
                                                            <td>{{ $vehicle->fuel_type }}</td>
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
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-primary"
                                                                        onclick="axiosModal('/vehicle/{{ $vehicle->id }}/edit')"
                                                                        title="Edit Driver">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                @if ($vehicle->status == 'active')
                                                                    @if (\Auth::user()->can('deactivate vehicle'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-success"
                                                                            onclick="axiosModal('/vehicle/{{ $vehicle->id }}/deactivate')"
                                                                            title="Dectivate Driver">
                                                                            <i class="fas fa-toggle-on"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    @if (\Auth::user()->can('activate vehicle'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-secondary"
                                                                            onclick="axiosModal('/vehicle/{{ $vehicle->id }}/activate')"
                                                                            title="Activate Driver">
                                                                            <i class="fas fa-toggle-off"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <span class='m-1'></span>
                                                                @if (\Auth::user()->can('delete vehicle'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="axiosModal('vehicle/{{ $vehicle->id }}/delete')"
                                                                        title="Delete">
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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
            <!-- end vue page -->
        </div>
        <!-- END layout-wrapper -->

        <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/vehicle/store" method="POST" class="needs-validation modal-content"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add New Vehicle</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="model" class="col-sm-5 col-form-label">Vehicle Model <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="model" class="form-control" type="text"
                                            placeholder="Vehicle Model" id="model" value="{{ old('model') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="make" class="col-sm-5 col-form-label">Vehicle Make <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="make" autocomplete="off" required class="form-control"
                                            type="text" placeholder="Vehicle Make" id="make"
                                            value="{{ old('make') }}">
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="year" class="col-sm-5 col-form-label">Vehicle Year of Manufacturer <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="year" class="form-control" type="date"
                                            placeholder="Year of Manufacturer" id="year" value="{{ old('year') }}">
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="vehicle_class" class="col-sm-5 col-form-label">Select Vehicle
                                        Class</label>
                                    <div class="col-sm-7">
                                        <select class="form-control basic-single select2" name="vehicle_class"
                                            id="vehicle_class" tabindex="-1" aria-hidden="true">
                                            <option value="">Please select Vehicle Class</option>
                                            @foreach ($vehicleClasses as $class)
                                                <option value="{{ $class->name }}">Class {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="plate_number" class="col-sm-5 col-form-label">Vehicle Number Plate <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="plate_number" class="form-control" type="text"
                                            placeholder="Enter Number Plate" id="plate_number"
                                            value="{{ old('plate_number') }}">
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="vehicle_avatar" class="col-sm-5 col-form-label">Vehicle Avatar <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="vehicle_avatar" class="form-control" type="file"
                                            placeholder="Enter Vehicle Avatar" id="vehicle_avatar"
                                            value="{{ old('vehicle_avatar') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="fuel_type" class="col-sm-5 col-form-label">Fuel Type <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="fuel_type" class="form-control" type="text"
                                            placeholder="Enter Vehicle Fuel Type" id="fuel_type"
                                            value="{{ old('fuel_type') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="engine_size" class="col-sm-5 col-form-label">Engine Size <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="engine_size" class="form-control" type="number"
                                            placeholder="Enter Engine Size" id="engine_size"
                                            value="{{ old('engine_size') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="seats" class="col-sm-5 col-form-label">Number of Seats <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="seats" class="form-control" type="number"
                                            placeholder="Enter Seats Number" id="seats" value="{{ old('seats') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="owner_name" class="col-sm-5 col-form-label">Owner's Name <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="owner_name" class="form-control" type="text"
                                            placeholder="Owner's Name" id="owner_name" value="{{ old('owner_name') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="owner_phone" class="col-sm-5 col-form-label">Owner's Phone <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="owner_phone" class="form-control" type="tel"
                                            placeholder="Owner's Phone Number" id="owner_phone"
                                            value="{{ old('owner_phone') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="status" class="col-sm-5 col-form-label">Status</label>
                                    <div class="col-sm-7">
                                        <select class="form-control basic-single select2" name="status" id="status"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="">Please Select Vehicle Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection
