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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Vehicle insurance recurring period lists
                                            </h6>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#insuranceRecurringModal">
                                                    <i class="fa-solid fa-user-plus"></i>&nbsp; Create
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                                @if ($period->status)
                                                                    <i class="fas fa-check-circle text-success"
                                                                        title="Active"></i>
                                                                @else
                                                                    <i class="fas fa-times-circle text-danger"
                                                                        title="Inactive"></i>
                                                                @endif
                                                            </td>
                                                            <td>{{ $period->description }}</td>
                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('/vehicle/insurance/recurring-period/{{ $period->id }}/edit')">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if (\Auth::user()->can('delete vehicle insurance company'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="deleteVehicle({{ $period->id }})">
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

        <div class="modal fade" id="insuranceRecurringModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('vehicle.insurance.recurring.period.create.store') }}" method="POST"
                    class="needs-validation modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add Insurance Company</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="name" class="col-sm-5 col-form-label">Period <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="period" class="form-control" type="text" placeholder="Period"
                                            id="name" value="{{ old('period') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="description" class="col-sm-5 col-form-label">Description</label>
                                    <div class="col-sm-7">
                                        <textarea name="description" autocomplete="off" class="form-control" type="text" placeholder="Description"
                                            id="email" value="{{ old('description') }}"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="status" class="col-sm-5 col-form-label">Status</label>
                                    <div class="col-sm-7">
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
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
