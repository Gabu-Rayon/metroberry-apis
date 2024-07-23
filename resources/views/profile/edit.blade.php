@extends('layouts.app')

@section('title', 'Profile')
@section('content')

    <div class="wrapper">
        @include('components.preloader')
        @include('components.sidebar.sidebar')
        <div class="content-wrapper">
            <div class="main-content">
                @include('components.navbar')
            </div>

            <div class="body-content">
                <div class="tile m-auto">

                    <div class="row justify-content-center">

                        <div class="col-md-8 col-xl-6">

                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fs-17 fw-semi-bold mb-0">Profile</h6>
                                </div>

                                <div class="card-body">

                                    <div class="text-center">
                                        <div class="media m-1">

                                            <div class="align-left p-1">

                                                <a href="#" class="profile-image">
                                                    <img src="{{ url('storage/' . \Auth::user()->avatar) }}"
                                                        class="avatar avatar-xl rounded-circle img-border height-100"
                                                        alt="Profile Image">
                                                </a>

                                            </div>

                                            <div class="media-body ms-3 mt-1">

                                                <h3
                                                    class="font-large-1 white d-flex justify-content-center align-items-center gap-3 cursor-pointer">
                                                    {{ Auth::user()->name }}
                                                    <span
                                                        class="badge bg-primary text-sm fs-6">{{ Auth::user()->role }}</span>
                                                </h3>

                                                <div class="row justify-content-center">

                                                    <table class="table table-borderless table-responsive">

                                                        <tbody>

                                                            <tr>
                                                                <th class="white">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                </th>
                                                                <td class="white text-start">
                                                                    {{ Auth::user()->address }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="white">
                                                                    <i class="fas fa-phone"></i>
                                                                </th>
                                                                <td class="white text-start">
                                                                    {{ Auth::user()->phone }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="white">
                                                                    <i class="fas fa-envelope"></i>
                                                                </th>
                                                                <td class="white text-start">
                                                                    {{ Auth::user()->email }}
                                                                </td>
                                                            </tr>

                                                            @if (Auth::user()->role == 'organisation')
                                                                <tr>
                                                                    <th class="white">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </th>
                                                                    <td class="white text-start">
                                                                        {{ Auth::user()->organisation->organisation_code }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role == 'organisation')
                            <div class="col-md-8 col-xl-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th title="Name">Name</th>
                                                <th title="ID Number">ID Number</th>
                                                <th title="Status">Status</th>
                                            </tr>
                                            <div class="float-end">
                                                <a href="{{ route('employee') }}" type="button" class="btn btn-primary">
                                                    Manage Employees
                                                </a>
                                            </div>
                                        </thead>
                                        <tbody>
                                            @if (Auth::user()->organisation->customers)
                                                @foreach (Auth::user()->organisation->customers as $employee)
                                                    <tr>
                                                        <td>{{ $employee->user->name }}</td>
                                                        <td>{{ $employee->national_id_no }}</td>
                                                        <td>
                                                            @if ($employee->status == 'active')
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">No employees found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @include('components.footer')
        </div>
    </div>

@endsection
