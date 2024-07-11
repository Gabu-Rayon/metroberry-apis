@extends('layouts.app')

@section('title', 'Insurance Company List')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Insurance Company List</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success" href="javascript:void(0);"
                                                        onclick="axiosModal('/vehicle/insurance/company/create')">
                                                        <i class="fa fa-plus"></i>&nbsp;
                                                        create
                                                    </a>
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
                                                            <th width="30">Sl</th>
                                                            <th>Name</th>
                                                            <th>Address</th>
                                                            <th>Email</th>
                                                            <th>Website</th>
                                                             <th title="Address">Status</th>
                                                            <th title="Action" width="150">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($insuranceCompanies as $key => $company)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $company->name }}</td>
                                                                <td>{{ $company->address }}</td>
                                                                <td>{{ $company->email }}</td>
                                                                <td>{{ $company->website }}</td>
                                                                    <td>
                                                        @if ($company->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                        @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                                 <td class="d-flex">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/edit')" title="Edit Driver">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <span class='m-1'></span>
                                                        @if ($company->status == 1)
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/deactivate')" title="Dectivate Driver">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </a> 
                                                        @else
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary" onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/activate')" title="Activate Driver">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>                                                        
                                                        @endif
                                                        <span class='m-1'></span>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/delete')" title="Delete">
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
