@extends('layouts.app')

@section('title', 'Create vehicle maintenance')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Create vehicle maintenance</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="admin/vehicle/maintenance" method="POST" class="needs-validation "
                                            novalidate="novalidate" enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="AQNLvAb467g0eZtkGATqrKcNNVohCNfvLiX4IjQc" autocomplete="off">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="type_id" class="fw-bold">
                                                            Requisition type
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="type_id" id="type_id" class="form-control"
                                                            required>
                                                            <option value="maintenance">
                                                                Maintenance
                                                            </option>
                                                            <option value="general">
                                                                General
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="priority" class="fw-bold">
                                                            Priority
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="priority" id="priority" class="form-control"
                                                            required>
                                                            <option value="low">
                                                                Low
                                                            </option>
                                                            <option value="medium">
                                                                Medium
                                                            </option>
                                                            <option value="high">
                                                                High
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="employee_id" class="fw-bold">
                                                            Requisition for
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="employee_id" id="employee_id" class="form-control"
                                                            data-ajax-url="admin/vehicle/maintenance/get-employee"
                                                            required>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label for="vehicle_id" class="fw-bold">
                                                            Vehicle
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="vehicle_id" id="vehicle_id" class="form-control"
                                                            data-ajax-url="admin/vehicle/maintenance/get-vehicle" required>
                                                        </select>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <label for="maintenance_type_id" class="fw-bold">
                                                            Maintenance type
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="maintenance_type_id" id="maintenance_type_id"
                                                            class="form-control"
                                                            data-ajax-url="admin/vehicle/maintenance/get-maintenance-type"
                                                            required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="date" class="fw-bold">
                                                            Date
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" class="form-control" id="date"
                                                            name="date" placeholder="Date" value="2024-07-06"
                                                            required>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label for="title" class="fw-bold">
                                                            Service title
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" placeholder="Title" value="" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="charge_bear_by" class="fw-bold">
                                                            Charge bear by
                                                        </label>
                                                        <input type="text" class="form-control" id="charge_bear_by"
                                                            name="charge_bear_by" placeholder="Charge bear by"
                                                            value="">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="charge" class="fw-bold">
                                                            Charge
                                                        </label>
                                                        <input type="number" class="form-control" id="charge"
                                                            name="charge" min="0" step=".01"
                                                            placeholder="Charge" value="0.00">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="remarks" class="fw-bold">
                                                            Remarks
                                                        </label>
                                                        <textarea name="remarks" id="remarks" class="form-control" rows="1" placeholder="Remarks"></textarea>
                                                    </div>


                                                </div>
                                                <div class="row my-5">
                                                    <div class="col-md-12">
                                                        <table class="table table-borderless table-striped"
                                                            id="driver-table">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th width="27%">
                                                                        Category <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="27%">
                                                                        Item <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="15%">
                                                                        Quantity <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="15%">
                                                                        Unit price <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="15%">
                                                                        Total price </th>
                                                                    <th>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody data-details="[]"></tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="card-body footer-info fixed-bottom bg-light py-3 z-index-1">
                                                    <ul class="nav
                align-items-center justify-content-end">
                                                        <li class="nav-item text-end pe-2">
                                                            <b class="">Net total</b>
                                                            <input type="number" step="0.01"
                                                                class="form-control text-end gross_total" value="0.00"
                                                                readonly autocomplete="off">
                                                        </li>
                                                        <li class="nav-item pe-2">
                                                            <b class="text-white">...</b>
                                                            <button type="submit"
                                                                class="form-control btn btn-sm btn-success align-bottom bg-success">Save
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
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
