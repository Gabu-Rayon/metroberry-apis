@extends('layouts.app')

@section('title', 'Vehicle List')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Vehicle Insurances</h6>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success btn-sm"
                                                        href={{ route('vehicle.insurance.export') }} title="Export">
                                                        <i class="fa-solid fa-file-export"></i>
                                                        &nbsp;
                                                        Export
                                                    </a>
                                                    <span class="m-1"></span>
                                                    <a class="btn btn-success btn-sm"
                                                        href={{ route('vehicle.insurance.import') }} title="Import">
                                                        <i class="fa-solid fa-file-import"></i>
                                                        &nbsp;
                                                        Import
                                                    </a>
                                                    <span class="m-1"></span>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#vehicleInsuranceModal">
                                                        <i class="fa-solid fa-user-plus"></i>&nbsp; Add Vehicle Insurance
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="driver-table">
                                                <thead>
                                                    <tr>
                                                        <th title="Name">Vehicle</th>
                                                        <th title="Type">Insurance Company</th>
                                                        <th title="Type">Policy Number</th>
                                                        <th title="Type">Charges</th>
                                                        <th title="Type">Status</th>
                                                        <th title="Nid">Issue Date</th>
                                                        <th title="Nid">Expiry Date</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vehicleInsurances as $insurance)
                                                        <tr>
                                                            <td>{{ $insurance->vehicle->model }}<br>({{ $insurance->vehicle->plate_number }})
                                                            </td>
                                                            <td>{{ $insurance->insuranceCompany->name }}</td>
                                                            <td>{{ $insurance->insurance_policy_no }}</td>
                                                            <td>kes.{{ $insurance->charges_payable }}</td>
                                                            <td>
                                                                @if ($insurance->status == 1)
                                                                    <span class="badge bg-success">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger">Inactive</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $insurance->insurance_date_of_issue }}</td>
                                                            <td>{{ $insurance->insurance_date_of_expiry }}</td>
                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('/vehicle/insurance/{{ $insurance->id }}/edit')">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class="m-1"></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('/vehicle/insurance/{{ $insurance->id }}/')">
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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
            <!-- end vue page -->
        </div>
        <!-- END layout-wrapper -->

        <div class="modal fade" id="insuranceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('vehicle.insurance.store') }}" method="POST" class="needs-validation modal-content"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add Vehicle Insurance Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="company_id" class="col-sm-5 col-form-label">Company Name <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <select class="form-control basic-single" name="insurance_company_id"
                                            id="insurance_company_id" tabindex="-1" aria-hidden="true" required>
                                            <option value="">Select Company</option>
                                            @foreach ($insuranceCompanies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="policy_number" class="col-sm-5 col-form-label">Policy Number <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="insurance_policy_no" class="form-control" type="text"
                                            placeholder="Policy number" id="policy_number" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="start_date" class="col-sm-5 col-form-label">Start Date</label>
                                    <div class="col-sm-7">
                                        <input name="insurance_date_of_issue" class="form-control" type="date"
                                            placeholder="Start date" id="start_date" value="">
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="recurring_period_id" class="col-sm-5 col-form-label">Recurring Period <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <select class="form-control basic-single" name="recurring_period_id"
                                            id="recurring_period_id" tabindex="-1" aria-hidden="true" required>
                                            <option value="">Select Recurring Period</option>
                                            @foreach ($recurringPeriods as $period)
                                                <option value="{{ $period->id }}">{{ $period->period }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="add_reminder" class="col-sm-5 col-form-label">Add Reminder</label>
                                    <div class="col-sm-7">
                                        <select name="reminder" id="add_reminder" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="status" class="col-sm-5 col-form-label">Status</label>
                                    <div class="col-sm-7">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="remarks" class="col-sm-5 col-form-label">Remarks</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="remark" id="remarks" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row mb-1">
                                    <label for="vehicle_id" class="col-sm-5 col-form-label">Vehicle <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <select class="form-control basic-single" name="vehicle_id" id="vehicle_id"
                                            tabindex="-1" aria-hidden="true" required>
                                            <option value="">Select Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="charge_payable" class="col-sm-5 col-form-label">Charge Payable <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="charges_payable" class="form-control" type="number" step="any"
                                            placeholder="Charge payable" id="charge_payable" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="end_date" class="col-sm-5 col-form-label">End Date</label>
                                    <div class="col-sm-7">
                                        <input name="insurance_date_of_expiry" class="form-control" type="date"
                                            placeholder="insurance date of expiry" id="end_date" value="">
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="recurring_date" class="col-sm-5 col-form-label">Recurring Date</label>
                                    <div class="col-sm-7">
                                        <input name="recurring_date" class="form-control" type="date"
                                            placeholder="Recurring date" id="recurring_date" value="">
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="deductible" class="col-sm-5 col-form-label">Deductible <i
                                            class="text-danger">*</i></label>
                                    <div class="col-sm-7">
                                        <input name="deductible" class="form-control" type="number" step="any"
                                            placeholder="Deductible" id="deductible" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="policy_document" class="col-sm-5 col-form-label">Policy Document <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="file" name="policy_document" id="organisation_certificate"
                                            required onchange="get_img_url(this, '#document_image');">

                                        <!--  <input
                                name="organisation_certificate"
                                class="form-control"
                                type="file"
                                placeholder="Certificate of Organisation"
                                id="organisation_certificate"
                                required
                            /> -->

                                        <img id="document_image" src="" width="120px" class="mt-1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="vehicleInsuranceModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('vehicle.insurance.store') }}" method="POST"
                                    class="needs-validation modal-content" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-header my-3 p-2 border-bottom">
                                        <h4>Add Vehicle Insurance Details</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group row my-2">
                                                    <label for="company_id" class="col-sm-5 col-form-label">Company
                                                        <i class="text-danger">*</i></label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control basic-single"
                                                            name="insurance_company_id" id="insurance_company_id"
                                                            tabindex="-1" aria-hidden="true" required>
                                                            <option value="">Select Company</option>
                                                            @foreach ($insuranceCompanies as $company)
                                                                <option value="{{ $company->id }}">{{ $company->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="policy_number" class="col-sm-5 col-form-label">Policy Number
                                                        <i class="text-danger">*</i></label>
                                                    <div class="col-sm-7">
                                                        <input name="insurance_policy_no" class="form-control"
                                                            type="text" placeholder="Policy number" id="policy_number"
                                                            value="{{ old('insurance_policy_no') }}" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="start_date" class="col-sm-5 col-form-label">Start
                                                        Date</label>
                                                    <div class="col-sm-7">
                                                        <input name="insurance_date_of_issue" class="form-control"
                                                            type="date" placeholder="Start date" id="start_date"
                                                            value="{{ old('insurance_date_of_issue') }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="recurring_period_id"
                                                        class="col-sm-5 col-form-label">Recurring Period <i
                                                            class="text-danger">*</i></label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control basic-single"
                                                            name="recurring_period_id" id="recurring_period_id"
                                                            tabindex="-1" aria-hidden="true" required>
                                                            <option value="">Select Recurring Period</option>
                                                            @foreach ($recurringPeriods as $period)
                                                                <option value="{{ $period->id }}">{{ $period->period }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="add_reminder" class="col-sm-5 col-form-label">Add
                                                        Reminder</label>
                                                    <div class="col-sm-7">
                                                        <select name="reminder" id="add_reminder" class="form-control">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="status" class="col-sm-5 col-form-label">Status</label>
                                                    <div class="col-sm-7">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="remarks" class="col-sm-5 col-form-label">Remarks</label>
                                                    <div class="col-sm-7">
                                                        <textarea class="form-control" name="remark" id="remarks" cols="30" rows="3">{{ old('remark') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-6">
                                                <div class="form-group row mb-1">
                                                    <label for="vehicle_id" class="col-sm-5 col-form-label">
                                                        Vehicle
                                                        <i class="text-danger">*</i></label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control basic-single" name="vehicle_id"
                                                            id="vehicle_id" tabindex="-1" aria-hidden="true" required>
                                                            <option value="">Select Vehicle</option>
                                                            @foreach ($vehicles as $vehicle)
                                                                <option value="{{ $vehicle->id }}">{{ $vehicle->model }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row my-2">
                                                    <label for="charge_payable" class="col-sm-5 col-form-label">Charge
                                                        Payable <i class="text-danger">*</i></label>
                                                    <div class="col-sm-7">
                                                        <input name="charges_payable" class="form-control" type="number"
                                                            step="any" placeholder="Charge payable"
                                                            id="charge_payable" value="{{ old('charges_payable') }}"
                                                            </div>
                                                    </div>

                                                    <div class="form-group row my-2">
                                                        <label for="end_date" class="col-sm-5 col-form-label">End
                                                            Date</label>
                                                        <div class="col-sm-7">
                                                            <input name="insurance_date_of_expiry" class="form-control"
                                                                type="date" placeholder="insurance date of expiry"
                                                                id="end_date"
                                                                value="{{ old('insurance_date_of_expiry') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row my-2">
                                                        <label for="recurring_date"
                                                            class="col-sm-5 col-form-label">Recurring
                                                            Date</label>
                                                        <div class="col-sm-7">
                                                            <input name="recurring_date" class="form-control"
                                                                type="date" placeholder="Recurring date"
                                                                id="recurring_date" value="{{ old('recurring_date') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row my-2">
                                                        <label for="deductible" class="col-sm-5 col-form-label">Deductible
                                                            <i class="text-danger">*</i></label>
                                                        <div class="col-sm-7">
                                                            <input name="deductible" class="form-control" type="number"
                                                                step="any" placeholder="Deductible" id="deductible"
                                                                value="{{ old('deductible') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row my-2">
                                                        <label for="policy_document"
                                                            class="col-sm-5 col-form-label">Policy
                                                            Document <span class="text-danger">*</span></label>
                                                        <div class="col-sm-7">
                                                            <input type="file" name="policy_document"
                                                                id="organisation_certificate" required
                                                                onchange="get_img_url(this, '#document_image');">

                                                            <img id="document_image" src="" width="120px"
                                                                class="mt-1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-success" type="submit">Save</button>
                                        </div>
                                </form>

                            </div>
                        </div>

                    @endsection
