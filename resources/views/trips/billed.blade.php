@extends('layouts.app')

@section('title', 'Billed Trips')
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
                                                            <th title="Name">Customer</th>
                                                            <th title="Billing Rate">Billing Rate</th>
                                                            <th title="Total Price" width="150">Total Price</th>
                                                            <th title="Billed At">Billed At</th>
                                                            <th title="Trip Status">Status</th>
                                                            <th title="Action" width="150">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($billedTrips as $trip)
                                                            <tr>
                                                                <td>{{ $trip->customer->user->name }}</td>
                                                                <td>{{ $trip->billingRate->name }}</td>
                                                                <td>{{ $trip->total_price }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($trip->billed_at)->format('F jS, Y \a\t h:i a') }}
                                                                </td>
                                                              <td>
    @if ($trip->status == 'billed')
        <span class="badge bg-success">Billed</span>
    @elseif ($trip->status == 'paid')
        <span class="badge bg-success">Paid</span>
    @else
        <span class="badge bg-danger">Partially Paid</span>
    @endif
</td>

                                                                <td class="text-center">
                                                                    <a href="{{ route('trip.payment.checkout', ['id' => $trip->id]) }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="Proceed to pay for your trip.">
                                                                        <small><i
                                                                             class="fa-solid fa-money-bill"></i></small>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="page-axios-data" data-table-id="#driver-table">
                                            </div>
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
