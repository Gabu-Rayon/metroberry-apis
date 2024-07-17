@extends('layouts.app')

@section('title', 'Checkout To A Trip')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Pay Your Trip</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6">
                                                <p class="mb-0 mr-3 text-dark fw-bold">Customer :</p>
                                                <div class="form-group row my-2">
                                                    <label for="plate_number" class="col-sm-5 col-form-label"> Name <i
                                                            class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->customer->user->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="fuel_type" class="col-sm-5 col-form-label">Address
                                                        <i class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->customer->user->address }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="engine_size" class="col-sm-5 col-form-label">org Code
                                                        <i class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->customer->customer_organisation_code }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <p class="mb-0 mr-3 text-dark fw-bold">Vehicle :</p>
                                                <div class="form-group row my-2">
                                                    <label for="plate_number" class="col-sm-5 col-form-label"> Plate No <i
                                                            class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->vehicle->plate_number }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="plate_number" class="col-sm-5 col-form-label"> Model <i
                                                            class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->vehicle->model }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="fuel_type" class="col-sm-5 col-form-label">Driver
                                                        <i class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->vehicle->driver->user->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="engine_size" class="col-sm-5 col-form-label">Driver Contact
                                                        <i class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->vehicle->driver->user->phone }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="engine_size" class="col-sm-5 col-form-label">Vehicle Org
                                                        <i class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->vehicle->organisation->user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <p class="mb-0 mr-3 text-dark fw-bold">Customer Org :</p>
                                                <div class="form-group row my-2">
                                                    <label for="color" class="col-sm-5 col-form-label">Org name <i
                                                            class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->customer->organisation->user->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row my-2">
                                                    <label for="color" class="col-sm-5 col-form-label">Org Address <i
                                                            class="text-danger">:</i></label>
                                                    <div class="col-sm-7">
                                                        {{ $trip->customer->organisation->user->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <table class="table" id="checkout-table">
                                                <thead>
                                                    <tr>
                                                        <th title="SrNo" width="30">SrNo</th>
                                                        <th title="Trip Route">Trip Route</th>
                                                        <th title="Billed By">Billed By</th>
                                                        <th title="Charges or Trip price ">Charges :</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $item = 1 @endphp
                                                    <tr>
                                                        <td>{{ $item++ }}</td>
                                                        <td> {{ $trip->route->name }}</td>
                                                        <td> {{ $trip->billed_by }}</td>
                                                        <td>Kes. {{ $trip->total_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-right my-20"><strong>Total</strong>
                                                        </td>
                                                        <td><strong>Kes.{{ $trip->total_price }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <div class="d-flex align-items-center mb-3">
                                                <p class="mb-0 mr-3 text-dark fw-bold">Pay with IntaSend</p>
                                                <span></span>
                                                <img src="{{ asset('admin-assets/img/payment-img/intasend-icon-20x27.png') }}"
                                                    alt="IntaSend Logo" class="img-fluid">
                                            </div>
                                            <div class="bg-secondary bg-gradient border rounded p-3">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('admin-assets/img/payment-img/IntasendPaymentGateways.png') }}"
                                                        alt="IntaSend payments Gateways" class="mr-3">
                                                </div>
                                                <p class="mb-0 mt-6 text-white fw-bold text-left">Secure mobile and card
                                                    payments.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="actions">
                                                <div class="accordion-header d-flex justify-content-end align-items-center"
                                                    id="flush-headingOne">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('billed.trip.send.invoice', ['id' => $trip->id]) }}')">
                                                        <i class="fa-solid fa-arrow-right"></i> &nbsp;
                                                        Send Trip invoice
                                                    </a>

                                                    <span class="m-1"></span>
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('billed.trip.resend.invoice', ['id' => $trip->id]) }}')">
                                                        <i class="fas fa-share-square"></i>
                                                        &nbsp;
                                                        Resend Trip Invoice
                                                    </a>
                                                    <span class="m-1"></span>
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('billed.trip.download.invoice', ['id' => $trip->id]) }}')">
                                                        <i class="fa-solid fa-download"></i>
                                                        &nbsp;
                                                        Download Trip Invoice
                                                    </a>
                                                    <span class="m-1"></span>
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('billed.trip.recieve.payment', ['id' => $trip->id]) }}')">
                                                        <i class="fa-solid fa-plus"></i>
                                                        &nbsp;
                                                        Receive Trip Payment
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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
    @endsection
