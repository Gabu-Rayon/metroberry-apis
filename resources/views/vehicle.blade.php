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
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('vehicle/create')">
                                                            <i class="fa fa-plus"></i>&nbsp;
                                                            Add vehicle
                                                        </a>

                                                        <button type="button" class="btn btn-success btn-sm mx-2"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                            aria-expanded="true" aria-controls="flush-collapseOne"> <i
                                                                class="fas fa-filter"></i> Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                    <div class="accordion-item">

                                                        <div id="flush-collapseOne"
                                                            class="accordion-collapse bg-white collapse"
                                                            aria-labelledby="flush-headingOne"
                                                            data-bs-parent="#accordionFlushExample" style="">

                                                            <div class='row pb-3 my-filter-form'>

                                                                <div class="col-sm-12 col-xl-4">
                                                                    <div class="form-group row mb-1">
                                                                        <label for="department"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Department
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control basic-single"
                                                                                name="department_id" id="department"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="1">IT</option>
                                                                                <option value="2">HR</option>
                                                                                <option value="3">Finance</option>
                                                                                <option value="4">Marketing</option>
                                                                                <option value="5">Sales</option>
                                                                                <option value="6">Production</option>
                                                                                <option value="7">Quality Control
                                                                                </option>
                                                                                <option value="8">Research and
                                                                                    Development</option>
                                                                                <option value="9">Customer Service
                                                                                </option>
                                                                                <option value="10">Logistics</option>
                                                                                <option value="11">Warehouse</option>
                                                                                <option value="12">Maintenance</option>
                                                                                <option value="13">Security</option>
                                                                                <option value="14">Administration
                                                                                </option>
                                                                                <option value="15">Legal</option>
                                                                                <option value="16">Purchasing</option>
                                                                                <option value="17">Accounting</option>
                                                                                <option value="18">Engineering</option>
                                                                                <option value="19">Management</option>
                                                                                <option value="20">Others</option>
                                                                                <option value="21">TRANSPORT</option>
                                                                                <option value="22">Abc</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mb-1">
                                                                        <label for="vehicle_type"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Vehicle
                                                                            type </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control basic-single"
                                                                                name="vehicle_type_id" id="vehicle_type"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="1">Saloon Car</option>
                                                                                <option value="2">Pick Up</option>
                                                                                <option value="3">Van</option>
                                                                                <option value="4">Bus</option>
                                                                                <option value="5">Truck</option>
                                                                                <option value="6">Motorcycle</option>
                                                                                <option value="7">Bicycle</option>
                                                                                <option value="8">Others</option>
                                                                                <option value="10">TATA SCHOOL BUS 0017
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-xl-4">
                                                                    <div class="form-group row mb-1">
                                                                        <label for="ownership"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Ownership
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control basic-single"
                                                                                name="ownership_id" id="ownership"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="1">Rented Own</option>
                                                                                <option value="3">Leased</option>
                                                                                <option value="4">Bank Financed
                                                                                </option>
                                                                                <option value="5">Third Party Financed
                                                                                </option>
                                                                                <option value="6">Own</option>
                                                                                <option value="7">Others</option>
                                                                                <option value="8">Laii</option>
                                                                                <option value="9">Quamar Browning
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mb-1">
                                                                        <label for="vendor"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Vendor
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control basic-single"
                                                                                name="vendor_id" id="vendor"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="1">Rahim Motors
                                                                                </option>
                                                                                <option value="2">Karim Cars</option>
                                                                                <option value="3">Tariq Traders
                                                                                </option>
                                                                                <option value="4">Ali Traders</option>
                                                                                <option value="5">Bilal Gears &amp; Co
                                                                                </option>
                                                                                <option value="6">Saeed Brothers
                                                                                </option>
                                                                                <option value="7">JAYESH FILING
                                                                                    STATION</option>
                                                                                <option value="8">C.K. MOTORS</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-xl-4">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-xl-12">
                                                                            <div class="form-group row mb-1">
                                                                                <label for="date_from"
                                                                                    class="col-sm-5 col-form-label justify-content-start text-left">Registration
                                                                                    from </label>
                                                                                <div class="col-sm-7">
                                                                                    <input name="date_from"
                                                                                        autocomplete="off"
                                                                                        class="form-control  w-100"
                                                                                        type="date" placeholder="From"
                                                                                        id="date_from">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-xl-12">
                                                                            <div class="form-group row mb-1">
                                                                                <label for="d_to"
                                                                                    class="col-sm-5 col-form-label justify-content-start text-left">Registration
                                                                                    to </label>
                                                                                <div class="col-sm-7">
                                                                                    <input name="date_to"
                                                                                        autocomplete="off"
                                                                                        class="form-control w-100"
                                                                                        type="date" placeholder="To"
                                                                                        id="d_to">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-2 d-flex align-items-center">
                                                                    <button class="btn btn-success me-2 search-btn"
                                                                        type="button">Search</button>
                                                                    <button class="btn btn-danger me-2 reset-btn"
                                                                        type="button">Reset</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="table-responsive">
                                                <table class="table" id="driver-table">
                                                    <thead>
                                                        <tr>
                                                            <th title="Sl" width="30">SrNo</th>
                                                            <th title="Seats">Model</th>
                                                            <th title="Plate Number">Year</th>
                                                            <th title="Insurance Issue Date">NumberPlate</th>
                                                            <th title="Insurance Expriry Date">Seats</th>
                                                            <th title="Insurance Issue Organisation">FuelType
                                                            </th>
                                                            <th title="Insurance Issue Organisation">EngineCC
                                                            </th>
                                                            <th title="Avatar">Avatar</th>
                                                            <th title="Driver">Driver</th>
                                                             <th title="Address">Status</th>
                                                            <th title="Action" width="150">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($vehicles as $vehicle)
                                                            <tr>
                                                                <td>{{ $vehicle->id }}</td>
                                                                <td>{{ $vehicle->model }}</td>
                                                                <td>{{ $vehicle->year }}</td>
                                                                <td>{{ $vehicle->plate_number }}</td>
                                                                <td>{{ $vehicle->seats }}</td>
                                                                <td>{{ $vehicle->fuel_type }}
                                                                </td>
                                                                <td>{{ $vehicle->engine_size }}<i>cc
                                                                    </i></td>
                                                                <td>
                                                                    @if ($vehicle->avatar)
                                                                        <img src="{{ asset('images/' . $vehicle->avatar) }}"
                                                                            alt="Avatar" width="50" height="50">
                                                                    @endif
                                                                </td>
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
                                                             <td>
                                                        @if ($vehicle->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                        @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
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
