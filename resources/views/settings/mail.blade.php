@extends('layouts.app')

@section('title', 'Mail Setting')
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
                                                <li class="nav-item mm-active ">
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
                                            <!--/.Content Header (Page header)-->
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="fs-17 fw-semi-bold mb-0">Mail setting</h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="admin/setting/mail" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="_token"
                                                        value="NQfgwyxFW4oekkaBD8XjlGvmJDoV6ejq5NQ79cyr"
                                                        autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_MAILER">Mail mailer</label>
                                                                <select name="MAIL_MAILER" id="MAIL_MAILER"
                                                                    class="form-control">
                                                                    <option value="smtp" selected>SMTP</option>
                                                                    <option value="sendmail">Sendmail</option>
                                                                    <option value="mailgun">Mailgun</option>
                                                                    <option value="ses">SES</option>
                                                                    <option value="postmark">Postmark</option>
                                                                    <option selected value="log">Log</option>
                                                                    <option value="array">Array</option>
                                                                    <option value="failover">Failover</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_HOST">Mail host</label>
                                                                <input type="text" class="form-control "
                                                                    id="MAIL_HOST" name="MAIL_HOST"
                                                                    placeholder="Mail host name"
                                                                    value="sandbox.smtp.mailtrap.io">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_PORT">Mail port</label>
                                                                <input type="number" class="form-control arrow-hidden"
                                                                    id="MAIL_PORT" name="MAIL_PORT"
                                                                    placeholder="Mail port number" value="2525">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_USERNAME">Mail username</label>
                                                                <input type="text" class="form-control "
                                                                    id="MAIL_USERNAME" name="MAIL_USERNAME"
                                                                    placeholder="Mail username" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_PASSWORD">Mail password</label>
                                                                <input type="password" class="form-control "
                                                                    id="MAIL_PASSWORD" name="MAIL_PASSWORD"
                                                                    placeholder="Mail password" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_FROM_ADDRESS">Sender email address</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS"
                                                                        placeholder="Sender email address"
                                                                        value="hello@example.com">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_FROM_NAME">Sender name</label>
                                                                <input type="text" class="form-control "
                                                                    id="MAIL_FROM_NAME" name="MAIL_FROM_NAME"
                                                                    placeholder="Sender name" value="${APP_NAME}">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="MAIL_ENCRYPTION">Mail encryption</label>
                                                                <select id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION"
                                                                    class="form-control">
                                                                    <option selected value="tls">TLS</option>
                                                                    <option value="ssl" selected="">SSL</option>
                                                                </select>
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
