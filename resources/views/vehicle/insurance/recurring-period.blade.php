@extends('layouts.app')

@section('title', 'Insurances Recurring Periods')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Vehicle insurance recurring period lists
                                                </h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success" href="javascript:void(0);"
                                                        onclick="axiosModal('/vehicle/insurance/recurring-period/create')">
                                                        <i class="fa fa-plus"></i>&nbsp;
                                                        Create
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
                                                            <th title="Name">Period</th>
                                                            <th title="Type">Status</th>
                                                            <th title="Type">Description</th>
                                                            <th title="Action" width="80">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($recurringPeriods as $period)
                                                            <tr>
                                                                <td>{{ $period->period }}</td>
                                                                <td>
                                                                    @if($period->status)
                                                                        <i class="fas fa-check-circle text-success" title="Active"></i>
                                                                    @else
                                                                        <i class="fas fa-times-circle text-danger" title="Inactive"></i>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $period->description }}</td>
                                                                <td class="d-flex">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-primary"
                                                                        onclick="axiosModal('/vehicle/insurance/recurring-period/{{ $period->id }}/edit')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <span class='m-1'></span>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="deleteVehicle({{ $period->id }})">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection
