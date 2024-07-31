@extends('layouts.app')

@section('title', 'Create Role')

@section('content')

    <body class="fixed sidebar-mini">
        @include('components.preloader')

        <!-- React page -->
        <div id="app">
            <!-- Begin page -->
            <div class="wrapper">
                <!-- Start header -->
                @include('components.sidebar.sidebar')
                <!-- End header -->

                <div class="content-wrapper">
                    <div class="main-content">
                        @include('components.navbar')

                        <div class="body-content">
                            <div class="tile">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fs-17 fw-semi-bold mb-0">Create New Role</h6>
                                            <div class="text-end">
                                                <a href="{{ route('permission.role') }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-list"></i>
                                                    &nbsp;Role List
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('permission.role.store') }}" method="POST"
                                        enctype="multipart/form-data" class="needs-validation">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group pt-1 pb-1">
                                                    <label for="name" class="font-black">Role Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Enter role name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12 pt-1 pb-1">
                                                <h5 class="border-bottom py-1 mx-1 mb-0 font-medium-2 font-black mt-5">
                                                    <i class="feather icon-lock mr-50"></i> Permission
                                                </h5>

                                                <div class="row mt-1">

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Dashboard Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($dashboardPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Profile Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($profilePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Employee Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($employeePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Organisation Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($organisationPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Driver Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($driverPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Driver's License Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($driverLicensePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Driver's PSV Badges Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($driverPSVBadgePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Driver Performance Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($driverPerformancePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Vehicle Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($vehiclePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Vehicle's Insurance Management Permissions</legend>
                                                            <div class="row py-3">
                                                                @foreach ($vehicleInsurancePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Vehicle's Inspection Certificte Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($vehicleInspCertPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Route Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($routePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Route Location Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($routeLocationPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Trip Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($tripPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Insurance Company Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($insuranceCompanyPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Insurance Recurring Period Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($insuranceRecurringPeriodPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Maintenance Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($maintenancePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Refuelling Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($refuellingPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Refuelling Station Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($refuellingStationPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Report Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($reportPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Report Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($reportPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Role Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($rolePermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Permission Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($permissionPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Settings Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($settingsPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Bank Account Management Permissions
                                                            </legend>
                                                            <div class="row py-3">
                                                                @foreach ($bankAccountPermissions as $permission)
                                                                    <div class="col-md-4 form-group">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" role="switch"
                                                                                id="{{ $permission }}"
                                                                                name="permissions[]"
                                                                                value="{{ $permission }}">
                                                                            <label class="form-check-label"
                                                                                for="{{ $permission }}">{{ $permission }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group pt-1 pb-1 text-center">
                                                    <button type="submit" class="btn btn-success btn-round">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="overlay"></div>
                        @include('components.footer')
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
