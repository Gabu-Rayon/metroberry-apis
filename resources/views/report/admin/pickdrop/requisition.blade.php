@extends('layouts.app')

@section('title', 'Pick Drop Requisition Report List')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Pick and drop requisition report</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">

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
                                                                        <label for="route"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Route
                                                                        </label>
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control basic-single"
                                                                                name="route_id" id="route"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="1">Dhaka to Mymensingh
                                                                                </option>
                                                                                <option value="2">SECTOR 4 MANAV
                                                                                    MANDIR</option>
                                                                                <option value="3">dewas amarnath
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-1">
                                                                        <label for="type"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Type
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control" name="type"
                                                                                id="type" tabindex="-1"
                                                                                aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="Pickup">Pick up</option>
                                                                                <option value="Drop">Drop off</option>
                                                                                <option value="PickDrop">Pick and drop
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-xl-4">
                                                                    <div class="form-group row mb-1">
                                                                        <label for="request_type"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Request
                                                                            type </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control"
                                                                                name="request_type" id="request_type"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="0">Regular</option>
                                                                                <option value="1">Specific day
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-xl-12">
                                                                        <div class="form-group row mb-1">
                                                                            <label for="date"
                                                                                class="col-sm-5 col-form-label justify-content-start text-left">Requisition
                                                                                date </label>
                                                                            <div class="col-sm-7">
                                                                                <input name="date" autocomplete="off"
                                                                                    class="form-control w-100"
                                                                                    type="date" id="date">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-xl-4">
                                                                    <div class="form-group row mb-1">
                                                                        <label for="status"
                                                                            class="col-sm-5 col-form-label justify-content-start text-left">Status
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <select class="form-control" name="status"
                                                                                id="status" tabindex="-1"
                                                                                aria-hidden="true">
                                                                                <option value="">Please select one
                                                                                </option>
                                                                                <option value="0">Pending</option>
                                                                                <option value="1">Release</option>
                                                                            </select>
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
                                                            <th title="Sl" width="30">Sl</th>
                                                            <th title="Route">Route</th>
                                                            <th title="Requisition date">Requisition date</th>
                                                            <th title="Requisition type">Requisition type</th>
                                                            <th title="Requested by">Requested by</th>
                                                            <th title="Request type">Request type</th>
                                                            <th title="Status">Status</th>
                                                        </tr>
                                                    </thead>
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
