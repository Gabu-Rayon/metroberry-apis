@extends('layouts.app')

@section('title', 'Metro-Berry Account Settings')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Manage Bank Account</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('/accounting-setting/create')">
                                                            <i class="fa fa-plus"></i>&nbsp;
                                                            Add New Account
                                                        </a>
                                                    </div>
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
                                                            <th title="Sl" width="30">SrNo</th>
                                                            <th title="name">Name</th>
                                                            <th title="Bank">Bank</th>
                                                            <th title="Account Number">Account No</th>
                                                            <th title="Current Balance">Current Balance</th>
                                                            <th title="Contact">Contact
                                                            </th>
                                                            <th title="Bank branch">Branch
                                                            </th>
                                                            <th title="Action" width="150">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($settings as $key => $setting)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $setting->holder_name }}</td>
                                                                <td>{{ $setting->bank_name }}</td>
                                                                <td>{{ $setting->account_number }}</td>
                                                                <td>{{ $setting->opening_balance }}</td>
                                                                <td>{{ $setting->contact_number }}</td>
                                                                <td>{{ $setting->bank_address }}</td>
                                                                <td class="d-flex">
                                                                    @if (\Auth::user()->can('edit accounting setting'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-primary"
                                                                            onclick="axiosModal('/accounting-setting/{{ $setting->id }}/edit')"
                                                                            title="Edit">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    @endif
                                                                    <span class='m-1'></span>
                                                                    @if (\Auth::user()->can('delete accounting setting'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-danger"
                                                                            onclick="axiosModal('/accounting-setting/{{ $setting->id }}/delete')"
                                                                            title="Delete">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    @endif
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
    @endsection
