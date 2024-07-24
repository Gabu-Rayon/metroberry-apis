@extends('layouts.app')

@section('title', 'Completed Trips List')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Completed Trips List</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                            </div>
                                        </div>

                                        <div>
                                            <div class="table-responsive">
                                               @if ($groupByOrganisation)
                                                @foreach ($trips as $organisationName => $tripsGroup)
                                                    <h5>{{ $organisationName }}</h5>
                                                     <table class="table" id="driver-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Customer</th>
                                                                <th>Driver</th>
                                                                <th>Vehicle</th>
                                                                <th>Route</th>
                                                                <th>Pick Up Time</th>
                                                                <th>Date</th>
                                                                <th>Pick Up Location</th>
                                                                <th>Drop Off Location</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($tripsGroup as $trip)
                                                                <tr>
                                                                    <td class="text-center">{{ $trip->customer->user->name ?? 'N/A' }}</td>
                                                                    <td class="text-center">
                                                                        @if ($trip->vehicle && $trip->vehicle->driver)
                                                                            {{ $trip->vehicle->driver->user->name ?? 'Unassigned' }}
                                                                        @else
                                                                            <span class="btn btn-danger btn-sm">Unassigned</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($trip->vehicle)
                                                                            <span class="btn btn-success btn-sm">{{ $trip->vehicle->plate_number }}</span>
                                                                        @else
                                                                            <span class="btn btn-danger btn-sm">Unassigned</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{ $trip->route->name ?? 'N/A' }}</td>
                                                                    <td class="text-center">{{ $trip->pick_up_time }}</td>
                                                                    <td class="text-center">
                                                                        {{ \Carbon\Carbon::parse($trip->trip_date)->format('F j, Y') }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @php
                                                                            $location = match($trip->pick_up_location) {
                                                                                'Home' => $trip->customer->user->address ?? 'N/A',
                                                                                'Office' => $trip->customer->organisation->user->address ?? 'N/A',
                                                                                default => $trip->route->locations->where('id', $trip->pick_up_location)->first()->name ?? 'N/A'
                                                                            };
                                                                        @endphp
                                                                        {{ $location }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @php
                                                                            $location = match($trip->drop_off_location) {
                                                                                'Home' => $trip->customer->user->address ?? 'N/A',
                                                                                'Office' => $trip->customer->organisation->user->address ?? 'N/A',
                                                                                default => $trip->route->locations->where('id', $trip->drop_off_location)->first()->name ?? 'N/A'
                                                                            };
                                                                        @endphp
                                                                        {{ $location }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            @else
                                                <table class="table" id="driver-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer</th>
                                                            <th>Driver</th>
                                                            <th>Vehicle</th>
                                                            <th>Route</th>
                                                            <th>Pick Up Time</th>
                                                            <th>Date</th>
                                                            <th>Pick Up Location</th>
                                                            <th>Drop Off Location</th>
                                                             @if (auth()->user()->role == 'admin' || auth()->user()->role == 'organisation' )
                                                            <th title="Action" width="150">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($completedTrips as $trip)
                                                            <tr>
                                                                <td class="text-center">{{ $trip->customer->user->name }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($trip->vehicle && $trip->vehicle->driver)
                                                                        {{ $trip->vehicle->driver->user->name ?? 'Unassigned' }}
                                                                    @else
                                                                        <span class="btn btn-danger btn-sm">Unassigned</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($trip->vehicle)
                                                                        <span
                                                                            class="btn btn-success btn-sm">{{ $trip->vehicle->plate_number }}</span>
                                                                    @else
                                                                        <span class="btn btn-danger btn-sm">Unassigned</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ $trip->route->name ?? 'N/A' }}</td>
                                                                <td class="text-center">{{ $trip->pick_up_time }}</td>
                                                                <td class="text-center">
                                                                    {{ \Carbon\Carbon::parse($trip->trip_date)->isoFormat('MMMM Do, YYYY') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @php
                                                                        $location = null;
                                                                        if ($trip->pick_up_location == 'Home') {
                                                                            $location = $trip->customer->user->address;
                                                                        } elseif ($trip->pick_up_location == 'Office') {
                                                                            $location =
                                                                                $trip->customer->organisation->user
                                                                                    ->address;
                                                                        } else {
                                                                            $location = $trip->route->locations
                                                                                ->where('id', $trip->pick_up_location)
                                                                                ->first()->name;
                                                                        }
                                                                    @endphp
                                                                    {{ $location }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @php
                                                                        $location = null;
                                                                        if ($trip->drop_off_location == 'Home') {
                                                                            $location = $trip->customer->user->address;
                                                                        } elseif (
                                                                            $trip->drop_off_location == 'Office'
                                                                        ) {
                                                                            $location =
                                                                                $trip->customer->organisation->user
                                                                                    ->address;
                                                                        } else {
                                                                            $location = $trip->route->locations
                                                                                ->where('id', $trip->drop_off_location)
                                                                                ->first()->name;
                                                                        }
                                                                    @endphp
                                                                    {{ $location }}
                                                                </td>
                                                                <td class="text-center">{{ $trip->drop_off_time }}</td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-primary"
                                                                        onclick="axiosModal('{{ $trip->id }}/details')"
                                                                        title="Details">
                                                                        <i class="fa-solid fa-circle-info"></i>
                                                                    </a>
                                                                    <span class='m-1'></span>
                                                                    @if ($trip->is_billable)
                                                                        <a href="javascript:void(0);"
                                                                            onclick="axiosModal('/trip/{{ $trip->id }}/bill')"
                                                                            class="btn btn-warning btn-sm" title="Bill">
                                                                            <i class="fa fa-file text-white"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">No completed trips available.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            @endif
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














   




