@extends('layouts.app')

@section('title', 'Enviroment Setting')
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
                            <!--/.Content Header (Page header)-->
                            <div class="body-content">
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                        <nav class="sidebar-nav card py-2 sub-side-bar p-2 py-3">
                                            <ul class=" nav">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                                        href="#" role="button" aria-expanded="false">
                                                        <i class="typcn typcn-adjust-brightness"></i>
                                                        General settings
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="">
                                                            <a href="admin/setting?g=Site"
                                                                class="dropdown-item settings-goroup">Site</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="admin/setting?g=Vendor"
                                                                class="dropdown-item settings-goroup">Vendor</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="admin/setting?g=Fuel"
                                                                class="dropdown-item settings-goroup">Fuel</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="admin/setting?g=Maintenance"
                                                                class="dropdown-item settings-goroup">Maintenance</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="admin/setting?g=Inventory"
                                                                class="dropdown-item settings-goroup">Inventory</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="admin/setting?g=Purchase"
                                                                class="dropdown-item settings-goroup">Purchase</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item  ">
                                                    <a href="admin/setting/mail">
                                                        <i class="typcn typcn-mail"></i>
                                                        Mail setting
                                                    </a>
                                                </li>
                                                <li class="nav-item mm-active ">
                                                    <a href="admin/setting/env">
                                                        <i class="typcn typcn-document-text"></i>
                                                        Env setting
                                                    </a>
                                                </li>
                                                <li class="nav-item  ">
                                                    <a href="admin/language">
                                                        <i class="typcn typcn-sort-alphabetically"></i>
                                                        Language
                                                    </a>
                                                </li>
                                                <li class="nav-item  ">
                                                    <a href="javascript:void(0);"
                                                        onclick="storageLink('dev/artisan-http/storage-link')">
                                                        <i class="typcn typcn-arrow-loop-outline"></i>
                                                        Fix storage link
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card mb-4 p-5">
                                            <!--/.Content Header (Page header)-->
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="fs-17 fw-semi-bold mb-0">Env setting</h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="admin/setting/env" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="_token"
                                                        value="NQfgwyxFW4oekkaBD8XjlGvmJDoV6ejq5NQ79cyr"
                                                        autocomplete="off">
                                                    <div class="alert alert-warning">
                                                        <p>
                                                            <strong>Note: </strong>
                                                            Every change there will have a direct impact on your apps
                                                            environment this may cause your app to crash so be careful in
                                                            every change you make
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="APP_NAME">System name</label>
                                                                <input type="text" class="form-control "
                                                                    id="APP_NAME" name="APP_NAME"
                                                                    placeholder="System name" value="vms-laravel">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="APP_URL">System site url</label>
                                                                <input type="url" class="form-control "
                                                                    id="APP_URL" name="APP_URL"
                                                                    placeholder="System site url" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="APP_URL">System environment</label>
                                                                <select class="form-control " name="APP_ENV"
                                                                    id="APP_ENV">
                                                                    <option value="local">
                                                                        Local
                                                                    </option>
                                                                    <option value="production" selected>
                                                                        Production
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="APP_DEBUG" value="1"
                                                                                name="APP_DEBUG" checked>
                                                                            <label class="form-check-label"
                                                                                for="APP_DEBUG">System app debug</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="FORCE_HTTPS" value="1"
                                                                                name="FORCE_HTTPS">
                                                                            <label class="form-check-label"
                                                                                for="FORCE_HTTPS">System force
                                                                                https</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- SAVE CHANGES ACTION BUTTON -->
                                                        <div class="col-12 border-0 text-right mb-2 mt-1">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
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
    @endsection
