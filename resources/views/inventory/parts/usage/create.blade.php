@extends('layouts.app')

@section('title', 'Employee List')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Create parts usage</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="inventory/parts/usage" method="POST" class="needs-validation "
                                            novalidate="novalidate" enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="AQNLvAb467g0eZtkGATqrKcNNVohCNfvLiX4IjQc" autocomplete="off">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="vehicle_id" class="fw-bold">
                                                            Vehicle
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="vehicle_id" id="vehicle_id" class="form-control"
                                                            data-ajax-url="inventory/parts/usage/get-vehicle" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="date" class="fw-bold">
                                                            Date
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" class="form-control" id="date"
                                                            name="date" placeholder="Date" value="2024-07-06"
                                                            required>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="remarks" class="fw-bold"> Remarks</label>
                                                        <textarea rows="1" class="form-control" id="remarks" name="remarks" placeholder="Remarks"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row my-5">
                                                    <div class="col-md-12">
                                                        <table class="table table-borderless table-striped"
                                                            id="purchase-table"
                                                            data-inventory-category-url="inventory/parts/usage/get-inventory-category"
                                                            data-parts-url="inventory/parts/usage/get-parts">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th width="30%">
                                                                        Category <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="30%">
                                                                        Item <span class="text-danger">*</span>
                                                                    </th>
                                                                    <th width="30%">
                                                                        Quantity <span class="text-danger">*</span>
                                                                    </th>
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
                    <footer class="footer-content border-top">
                        <div class="footer-text">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="copy">
                                        © 2024 <a class="text-capitalize text-black" href="" target="_blank">Vms
                                            laravel</a>.
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="credit">Designed and developed by: <a class="text-black text-capitalize"
                                            href="https://www.bdtask.com/" target="_blank">Bdtask<a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
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
        <!--Global script(used by all pages)-->
        <script src="../../../admin-assets/vendor/jQuery/jquery.min.js?v=1"></script>
        <script src="../../../admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js?v=1"></script>
        <script src="../../../admin-assets/vendor/emojionearea/dist/emojionearea.min.js?v=1"></script>

        <script src="../../../admin-assets/vendor/select2/dist/js/select2.min.js?v=1"></script>
        <script src="module-assets/Language/js/localizer.min.js?v=1"></script>

        <script src="../../../admin-assets/vendor/metisMenu/metisMenu.min.js?v=1"></script>
        <script src="../../../admin-assets/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/sweetalert2/sweetalert2.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/fontawesome-free-6.3.0-web/js/all.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/toastr/build/toastr.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/axios/dist/axios.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/typed.js/lib/typed.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/vendor/jquery-validation-1.19.5/jquery.validate.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/axios.init.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/arrow-hidden.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/img-src.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/delete.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/user-status-update.min.js?v=1"></script>
        <script src="../../../nanopkg-assets/js/main.js?v=1"></script>

        <!--Page Scripts(used by all page)-->
        <script src="../../../admin-assets/js/sidebar.min.js?v=1"></script>
        <script src="module-assets/Inventory/js/parts-usage.min.js?v=1"></script>
        <!-- end scripts -->
        <script src="../../../nanopkg-assets/js/tosterSession.min.js?v=1"></script>
    </body>

    </html>
