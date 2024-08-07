@extends('layouts.app')

@section('title', 'Scheduled Trips')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Scheduled Trips</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        @if (Auth::user()->can('schedule trip'))
                                                            <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                                onclick="axiosModal('/trip/create')">
                                                                <i class="fa fa-plus"></i>
                                                                &nbsp;
                                                                Schedule A Trip
                                                            </a>
                                                        @endif
                                                        <span class="m-1"></span>
                                                        @if (auth()->user()->can('assign vehicle to upcoming trips'))
                                                            <a class="btn btn-success btn-sm"
                                                                href="{{ route('trip.vehicle-assign') }}">
                                                                <i class="fas fa-share-square"></i>
                                                                &nbsp;
                                                                Assign Vehicles to Upcoming Trips
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th title="Name">Customer</th>
                                                            <th title="Location">Driver</th>
                                                            <th title="NoOfEmployee">Vehicle</th>
                                                            <th title="Registration date">Route</th>
                                                            <th title="Email">Time</th>
                                                            <th title="Email">Date</th>
                                                            <th title="Email">Pick Up</th>
                                                            <th title="Email">Drop Off</th>
                                                            @if (auth()->user()->role == 'admin')
                                                                <th title="Action" width="150">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if (is_null($organisations))
                                                            <tr>
                                                                <td colspan="9" class="text-center text-danger">
                                                                    Organisations is null
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if (is_null($givenRoutes))
                                                            <tr>
                                                                <td colspan="9" class="text-center text-danger">
                                                                    GivenRoutes is null
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @foreach ($scheduledTrips as $organisationCode => $routes)
                                                            @if (auth()->user()->role == 'admin')
                                                                <tr>
                                                                    <td colspan="9" class="text-center">
                                                                        <h5 class="text-primary text-sm">
                                                                            @php
                                                                                $organisation = $organisations
                                                                                    ->where(
                                                                                        'organisation_code',
                                                                                        $organisationCode,
                                                                                    )
                                                                                    ->first();
                                                                            @endphp
                                                                            {{ $organisation->user->name }}
                                                                        </h5>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @foreach ($routes as $routeName => $trips)
                                                                <tr>
                                                                    <td colspan="9" class="text-center">
                                                                        <h6 class="text-info text-sm">
                                                                            @php
                                                                                $route = $givenRoutes
                                                                                    ->where('id', $routeName)
                                                                                    ->first();
                                                                            @endphp
                                                                            {{ $route->name }}
                                                                        </h6>
                                                                    </td>
                                                                </tr>
                                                                @foreach ($trips as $trip)
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            {{ $trip->customer->user->name }}</td>
                                                                        <td class="text-center">
                                                                            @if ($trip->vehicle)
                                                                                {{ $trip->vehicle->driver->user->name }}
                                                                            @else
                                                                                <span
                                                                                    class="btn btn-warning btn-sm">TBD</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @if ($trip->vehicle)
                                                                                <span
                                                                                    class="btn btn-success btn-sm">{{ $trip->vehicle->plate_number }}</span>
                                                                            @else
                                                                                <span
                                                                                    class="btn btn-warning btn-sm">TBD</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">{{ $trip->route->name }}
                                                                        </td>
                                                                        <td class="text-center">{{ $trip->pick_up_time }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ \Carbon\Carbon::parse($trip->trip_date)->isoFormat('MMMM Do, YYYY') }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @php
                                                                                $location = null;
                                                                                if ($trip->pick_up_location == 'Home') {
                                                                                    $location =
                                                                                        $trip->customer->user->address;
                                                                                } elseif (
                                                                                    $trip->pick_up_location == 'Office'
                                                                                ) {
                                                                                    $location =
                                                                                        $trip->customer->organisation
                                                                                            ->user->address;
                                                                                } else {
                                                                                    Log::info('TRIP');
                                                                                    Log::info($trip);
                                                                                    $location = $trip->route->route_locations
                                                                                        ->where(
                                                                                            'id',
                                                                                            $trip->pick_up_location,
                                                                                        )
                                                                                        ->first()->name;
                                                                                }
                                                                            @endphp
                                                                            {{ $location }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            @php
                                                                                $location = null;
                                                                                if (
                                                                                    $trip->drop_off_location == 'Home'
                                                                                ) {
                                                                                    $location =
                                                                                        $trip->customer->user->address;
                                                                                } elseif (
                                                                                    $trip->drop_off_location == 'Office'
                                                                                ) {
                                                                                    $location =
                                                                                        $trip->customer->organisation
                                                                                            ->user->address;
                                                                                } else {
                                                                                    $location = $trip->route->route_locations
                                                                                        ->where(
                                                                                            'id',
                                                                                            $trip->drop_off_location,
                                                                                        )
                                                                                        ->first()->name;
                                                                                }
                                                                            @endphp
                                                                            {{ $location }}
                                                                        </td>
                                                                        @if (auth()->user()->role == 'admin')
                                                                            <td class="text-center">
                                                                                <a href="javascript:void(0);"
                                                                                    onclick="axiosModal('/trip/{{ $trip->id }}/cancel')"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    title="Cancel">
                                                                                    <i class="fa fa-times"></i>
                                                                                </a>
                                                                                <span class='m-1'></span>
                                                                                <a href="javascript:void(0);"
                                                                                    onclick="axiosModal('/trip/{{ $trip->id }}/complete')"
                                                                                    class="btn btn-primary btn-sm"
                                                                                    title="Complete">
                                                                                    <i class="fa fa-check"></i>
                                                                                </a>
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
            <!--end vue page -->
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
                                <p>Are you sure you want to delete this item? you won’t be able to revert this item back!
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
