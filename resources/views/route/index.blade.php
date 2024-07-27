@extends('layouts.app')

@section('title', 'Routes')
@section('content')

    <body class="fixed sidebar-mini">
        @include('components.preloader')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Routes</h6>
                                            <div class="text-end">
                                                <a class="btn btn-success btn-sm" href={{ route('route.export') }}
                                                    title="Export">
                                                    <i class="fa-solid fa-file-export"></i>&nbsp; Export
                                                </a>
                                                <span class='m-1'></span>
                                                <a class="btn btn-success btn-sm" href="{{ route('route.import') }}"
                                                    title="Import From csv excel file">
                                                    <i class="fa-solid fa-file-arrow-up"></i>&nbsp; Import
                                                </a>
                                                <span class="m-1"></span>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#routeModal">
                                                    <i class="fa-solid fa-user-plus"></i>&nbsp; Add Route
                                                </button>
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
                        <div class="overlay"></div>
                        @include('components.footer')
                    </div>
                </div>
                <!-- end vue page -->
            </div>
            <!-- END layout-wrapper -->

            <div class="modal fade" id="routeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('route.store') }}" method="POST" class="needs-validation modal-content"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header my-3 p-2 border-bottom">
                            <h4>Add Route</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group row my-2">
                                        <label for="start_location" class="col-sm-5 col-form-label">
                                            Start Location <i class="text-danger">*</i>
                                        </label>
                                        <div class="col-sm-7">
                                            <input name="start_location" class="form-control" type="text"
                                                placeholder="Start Location" id="start_location" required />
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label for="county" class="col-sm-5 col-form-label">
                                            County <i class="text-danger">*</i>
                                        </label>
                                        <div class="col-sm-7">
                                            <input name="county" class="form-control" type="text" placeholder="County"
                                                id="county" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group row my-2">
                                        <label for="end_location" class="col-sm-5 col-form-label">
                                            End Location <i class="text-danger">*</i>
                                        </label>
                                        <div class="col-sm-7">
                                            <input name="end_location" class="form-control" type="text"
                                                placeholder="End Location" id="end_location" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
