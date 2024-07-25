@extends('layouts.app')

@section('title', 'Insurance Companies')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Insurance Companies
                                            </h6>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#insuranceCompaniesModal">
                                                    <i class="fa-solid fa-plus"></i>&nbsp; Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/edit')"
                                                                    title="Edit Driver">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if ($company->status == 1)
                                                                    @if (\Auth::user()->can('activate vehicle insurance company'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-success"
                                                                            onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/deactivate')"
                                                                            title="Dectivate Driver">
                                                                            <i class="fas fa-toggle-on"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    @if (\Auth::user()->can('activate vehicle insurance company'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-secondary"
                                                                            onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/activate')"
                                                                            title="Activate Driver">
                                                                            <i class="fas fa-toggle-off"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <span class='m-1'></span>
                                                                @if (\Auth::user()->can('delete vehicle insurance company'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="axiosModal('/vehicle/insurance/company/{{ $company->id }}/delete')"
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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
            <!-- end vue page -->
        </div>
        <!-- END layout-wrapper -->

        <div class="modal fade" id="insuranceCompaniesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('vehicle.insurance.company.store') }}" method="POST"
                    class="needs-validation modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add Insurance Company</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="name" class="col-sm-5 col-form-label">Company Name <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="name" class="form-control" type="text" placeholder="Company Name"
                                            id="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="email" class="col-sm-5 col-form-label">Email</label>
                                    <div class="col-sm-7">
                                        <input name="email" autocomplete="off" class="form-control" type="email"
                                            placeholder="Email" id="email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="address" class="col-sm-5 col-form-label">Address</label>
                                    <div class="col-sm-7">
                                        <input name="address" class="form-control" type="text" placeholder="Address"
                                            id="address" value="{{ old('address') }}">
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="website" class="col-sm-5 col-form-label">Website</label>
                                    <div class="col-sm-7">
                                        <input name="website" class="form-control" type="text" placeholder="Website"
                                            id="website" value="{{ old('website') }}">
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
    </body>
@endsection
