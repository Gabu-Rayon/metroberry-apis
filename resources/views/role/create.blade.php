@extends('layouts.app')

@section('title', 'Create Role')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Create new role</h6>
                                        </div>
                                        <div class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('permission.role') }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-list"></i>
                                                    &nbsp;Role list
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form enctype="multipart/form-data"
                                            action="{{route('permission.role.store')}}" method="POST"
                                             @METHOD('POST')
                                             @csrf
                                            <div class=" row">
                                                <div class="col-md-12">
                                                    <div class="form-group pt-1 pb-1">
                                                        <label for="name" class="font-black">Role name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Enter role name"
                                                            value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 pt-1 pb-1">
                                                    <div>
                                                        <h5
                                                            class="border-bottom py-1 mx-1 mb-0 font-medium-2 font-black mt-5">
                                                            <i class="feather icon-lock mr-50 "></i>
                                                            Permission
                                                        </h5>
                                                        <div class="row mt-1">

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Settings Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($settingPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Dashboard Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($dashboardPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Employee Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($employeePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Organisation Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($organisationPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Drivers Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($driversPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Driver's License Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($licensePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Driver's PSV Badge Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($psv_badgePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Driver Performance Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($driver_performancePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($vehiclePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Insurance Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($vehicle_insurancePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Route Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($routePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Route Location Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($route_locationPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Trip Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($tripPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Insurance Company Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($insurance_companyPermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Maintenance Permissions
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        @foreach ($vehicle_maintenancePermissions as $permission)
                                                                            
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $permission->permission_name }}" name="{{ $permission->permission_name }}" value="{{ $permission->id }}">
                                                                                <label class="form-check-label" for="{{ $permission->permission_name }}">
                                                                                    {{ $permission->permission_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    </div>
                                                                </fieldset>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group pt-1 pb-1 text-center">
                                                        <button type="submit"
                                                            class="btn btn-success btn-round">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

@endsection
