@extends('layouts.app')

@section('title', 'Fuel Stations')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Fuel Stations</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('refueling.station.create') }}')">
                                                        <i class="fa fa-plus"></i>&nbsp;
                                                        Add Refueling Station
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
                                                            <th title="Name">Name</th>
                                                            <th title="Email">Email</th>
                                                            <th title="Phone">Phone</th>
                                                            <th title="Address">Address</th>
                                                            <th title="Status">Status</th>
                                                            <th title="Action" width="80">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($stations as $station)
                                                            <tr>
                                                                <td>{{ $station->user->name }}</td>
                                                                <td>{{ $station->user->email }}</td>
                                                                <td>{{ $station->user->phone }}</td>
                                                                <td>{{ $station->user->address }}</td>
                                                                <td class="text-center">
                                                                    @php
                                                                        $certificateOfOperations =
                                                                            $station->certificate_of_operations;

                                                                        if ($station->status == 'inactive') {
                                                                            if (!$certificateOfOperations) {
                                                                                $badgeClass = 'badge bg-danger';
                                                                                $badgeText = 'Missing Documents';
                                                                            } else {
                                                                                $badgeClass =
                                                                                    'badge bg-warning text-dark';
                                                                                $badgeText = 'Pending Verification';
                                                                            }
                                                                        } else {
                                                                            $badgeClass = 'badge bg-success';
                                                                            $badgeText = 'Active';
                                                                        }
                                                                    @endphp
                                                                    <span
                                                                        class="{{ $badgeClass }}">{{ $badgeText }}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('refueling.station.edit', $station->id) }}')"
                                                                        class="btn btn-primary btn-sm">
                                                                        <i class="fa fa-edit fa-sm"></i>
                                                                    </a>
                                                                    @if ($station->status == 'active')
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-success"
                                                                            onclick="axiosModal('{{ route('refueling.station.deactivate', $station->id) }}')"
                                                                            title="Deactivate Station">
                                                                            <i class="fas fa-toggle-on"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-secondary"
                                                                            onclick="axiosModal('{{ route('refueling.station.activate', $station->id) }}')"
                                                                            title="Activate Station">
                                                                            <i class="fas fa-toggle-off"></i>
                                                                        </a>
                                                                    @endif
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('refueling.station.delete', $station->id) }}')"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fa fa-trash fa-sm"></i>
                                                                    </a>
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
        <!-- start scripts -->
    @endsection
