<!doctype html>
<html lang="en">

<head>
    @extends('layouts.app')

    @section('title', 'Vendor Setting')
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
                                                        <li class="mm-active">
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
                                                <li class="nav-item  ">
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
                                            <form action="admin/setting" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token"
                                                    value="NQfgwyxFW4oekkaBD8XjlGvmJDoV6ejq5NQ79cyr" autocomplete="off">
                                                <input type="hidden" name="_method" value="PUT"> <input
                                                    type="hidden" name="setting_tab" class="setting_tab"
                                                    value="Vendor" />

                                                <div>
                                                    <fieldset>
                                                        <legend>Code Prefix</legend>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="panel-heading my-2">
                                                                <code
                                                                    class="badge badge-pill badge-info text-light setting_key">setting('vendor.code_prefix')</code>
                                                                <a href="javascript:void(0);"
                                                                    class="panel-action-btn clipboard"
                                                                    data-clipboard-text="setting('vendor.code_prefix')">
                                                                    <svg width="18px" version="1.1"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                        y="0px" viewBox="0 0 1000 1000"
                                                                        enable-background="new 0 0 1000 1000"
                                                                        xml:space="preserve">
                                                                        <g>
                                                                            <g>
                                                                                <path
                                                                                    d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div class="panel-actions">
                                                                <a href="admin/setting/7/move-down"
                                                                    class="panel-action-btn" title="Move Down">
                                                                    <img
                                                                        src="../../../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                                                                </a>
                                                                <a href="admin/setting/7/move-up" class="panel-action-btn"
                                                                    title="Move Up">
                                                                    <img
                                                                        src="../../../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body mt-1 mb-3">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input id="vendor.code_prefix" class="form-control"
                                                                        type="text" placeholder="Setting Code Prefix"
                                                                        name="data[7]" id="data[7]" value="VEN-" />
                                                                    <div class="my-1">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                </div>
                                                <div class="d-flex justify-content-end mt-5">
                                                    <button type="submit" class="btn btn-success">Save settings</button>
                                                </div>

                                            </form>
                                            <span id="media-upload-url"
                                                data-file-upload-url="admin/setting/file-upload"></span>
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
