@extends('layouts.app')

@section('title', 'Route Locations')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Routes Locations</h6>
                                        </div>
                                        <div class="text-end">
                                            <div class="actions">
                                                <div class="accordion-header d-flex justify-content-end align-items-center"
                                                    id="flush-headingOne">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('location/create')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Add Route Location
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm mx-2" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                        <i class="fas fa-filter"></i>
                                                        Filter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card-body">
                                        <div>
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
                                                                    <label for="name"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">Name</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            placeholder="Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-xl-4">
                                                                
                                                            </div>

                                                            <div class="col-sm-12 col-xl-4">
                                                                <div class="form-group row mb-1">
                                                                    <label for="address"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">Address</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control"
                                                                            id="address" name="address"
                                                                            placeholder="Address">
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
                                            <div class="table-responsive">
                                                 <table class="table" id="driver-table">
                                            <thead>
                                                <tr>
                                                    <th title="Name">Route</th>
                                                    <th title="Name">Name</th>
                                                    <th title="Email">Point Order</th>
                                                    <th title="Action" width="80">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($routelocations as $routelocation)
                                                <tr>
                                                    <td>{{ $routelocation->route->name }}</td>
                                                    <td>{{ $routelocation->name }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            if ($routelocation->is_start_location) {
                                                                $point_order = 'Start Location';
                                                            } else if ($routelocation->is_end_location) {
                                                                $point_order = 'End Location';
                                                            } else {
                                                                $point_order = $routelocation->point_order;
                                                            }
                                                        @endphp
                                                        <span>{{ $point_order }}</span>                                                  
                                                    <td class="d-flex">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('location/{{ $routelocation->id }}/edit')">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <span class='m-1'></span>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="axiosModal('location/{{ $routelocation->id }}/delete')">
                                                            <i class="fas fa-trash"></i>
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
