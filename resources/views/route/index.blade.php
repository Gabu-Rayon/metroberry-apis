@extends('layouts.app')

@section('title', 'Routes')
@section('content')

    <body class="fixed sidebar-mini">
        @include('components.preloader')
        <div id="app">
            <div class="wrapper">
                @include('components.sidebar.sidebar')
                <div class="content-wrapper">
                    <div class="main-content">
                        @include('components.navbar')
                        <div class="body-content">
                            <div class="tile">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-17 fw-semi-bold mb-0">Routes</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div
                                                        class="accordion-header d-flex justify-content-end align-items-center"id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('route/create')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Add Route
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="driver-table">
                                                <thead>
                                                    <tr>
                                                        <th title="Name">Name</th>
                                                        <th title="Name">County</th>
                                                        <th title="Email">Start Location</th>
                                                        <th title="Address">Waypoints</th>
                                                        <th title="Phone">End Location</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($routes as $route)
                                                        <tr>
                                                            <td>{{ $route->name }}</td>
                                                            <td>{{ $route->county }}</td>
                                                            <td class="text-center">
                                                                {{ $route->start_location->name ?? '-' }}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $waypoints = $route->waypoints->sortBy(
                                                                        'point_order',
                                                                    );
                                                                @endphp
                                                                @foreach ($waypoints as $key => $waypoint)
                                                                    {{ $waypoint->name }}
                                                                    @if (!$loop->last)
                                                                        -
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td class="text-center">{{ $route->end_location->name ?? '-' }}
                                                            </td>
                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('route/{{ $route->id }}/edit')">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('route/{{ $route->id }}/delete')">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="delete-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Are you sure you want to delete this employee? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

@endsection
