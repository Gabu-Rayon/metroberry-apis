@extends('layouts.app')

@section('title', 'Employees')
@section('content')

<div class="body-content">
    <div class="tile">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">Employee list</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <div class="accordion-header d-flex justify-content-end align-items-center" id="flush-headingOne">
                                <a class="btn btn-success btn-sm"  href="javascript:void(0);">
                                    <i class="fa fa-plus"></i>&nbsp;
                                    Add employee
                                </a>
                                <button type="button" class="btn btn-success btn-sm mx-2" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne"> <i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <div id="flush-collapseOne" class="accordion-collapse bg-white collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                    <div class='row pb-3 my-filter-form'>
                                        <div class="col-sm-12 col-xl-4">
                                            <div class="form-group row mb-1">
                                                <label for="emp_type" class="col-sm-5 col-form-label justify-content-start text-left">Employee type                    </label>
                                                <div class="col-sm-7">
                                                    <select class="form-control basic-single" name="employee_type" id="emp_types" tabindex="-1" aria-hidden="true">
                                                        <option value="">Please select one</option>
                                                        <option value="Internal">Internal</option>
                                                        <option value="External">External</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label for="blood" class="col-sm-5 col-form-label justify-content-start text-left">Blood group </label>
                                                <div class="col-sm-7">
                                                    <select class="form-control basic-single" name="blood_group" id="shbloodg" tabindex="-1" aria-hidden="true">
                                                        <option value="">Please select one</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-4">
                                            <div class="form-group row mb-1">
                                                <label for="department" class="col-sm-5 col-form-label justify-content-start text-left">Department <i class="text-danger">*</i></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control basic-single required" name="department" id="departmentsh" tabindex="-1" aria-hidden="true">
                                                        <option value="">Please select one</option>
                                                        <option value="1">IT</option>
                                                        <option value="2">HR</option>
                                                        <option value="3">Finance</option>
                                                        <option value="4">Marketing</option>
                                                        <option value="5">Sales</option>
                                                        <option value="6">Production</option>
                                                        <option value="7">Quality Control</option>
                                                        <option value="8">Research and Development</option>
                                                        <option value="9">Customer Service</option>
                                                        <option value="10">Logistics</option>
                                                        <option value="11">Warehouse</option>
                                                        <option value="12">Maintenance</option>
                                                        <option value="13">Security</option>
                                                        <option value="14">Administration</option>
                                                        <option value="15">Legal</option>
                                                        <option value="16">Purchasing</option>
                                                        <option value="17">Accounting</option>
                                                        <option value="18">Engineering</option>
                                                        <option value="19">Management</option>
                                                        <option value="20">Others</option>
                                                        <option value="21">TRANSPORT</option>
                                                        <option value="22">Abc</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label for="designation" class="col-sm-5 col-form-label justify-content-start text-left">Designation <i class="text-danger">*</i></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control basic-single required" name="designation" id="designationsh" tabindex="-1" aria-hidden="true">
                                                        <option value="">Please select one</option>
                                                        <option value="2">CFO</option>
                                                        <option value="3">COO</option>
                                                        <option value="4">CTO</option>
                                                        <option value="5">CMO</option>
                                                        <option value="6">CIO</option>
                                                        <option value="7">CISO</option>
                                                        <option value="8">CRO</option>
                                                        <option value="9">CDO</option>
                                                        <option value="10">CLO</option>
                                                        <option value="11">CHRO</option>
                                                        <option value="12">CSO</option>
                                                        <option value="13">CPO</option>
                                                        <option value="14">CQO</option>
                                                        <option value="15">CVO</option>
                                                        <option value="16">CBO</option>
                                                        <option value="17">CNO</option>
                                                        <option value="18">CWO</option>
                                                        <option value="19">DRIVER</option>
                                                        <option value="20">COMPUTER OPRRATOR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-4">
                                            <div class="row">
                                                <div class="col-sm-12 col-xl-12">
                                                    <div class="form-group row mb-1">
                                                        <label for="join_datefrsh" class="col-sm-5 col-form-label justify-content-start text-left">Joining date from</label>
                                                        <div class="col-sm-7">
                                                            <input name="join_date_from" autocomplete="off" class="form-control  w-100" type="date" placeholder="Joining date from" id="join_datefrsh">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xl-12">
                                                    <div class="form-group row mb-1">
                                                        <label for="joining_d_to" class="col-sm-5 col-form-label justify-content-start text-left">Joining date to</label>
                                                        <div class="col-sm-7">
                                                            <input name="join_date_to" autocomplete="off" class="form-control w-100" type="date" placeholder="Joining date to" id="joining_d_to">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button class="btn btn-success me-2 search-btn" type="button">Search</button>
                                            <button class="btn btn-danger me-2 reset-btn" type="button">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table" id="employee-table">
                            <thead>
                                <tr>
                                    <th title="Name">Name</th>
                                    <th title="Type">Email</th>
                                    <th title="Type">Phone</th>
                                    <th title="Nid">Address</th>
                                    <th title="Department">Organisation</th>
                                    <th title="Action" width="80">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->user->name }}</td>
                                        <td>{{ $customer->user->email }}</td>
                                        <td>{{ $customer->user->phone }}</td>
                                        <td>{{ $customer->user->address }}</td>
                                        <td>{{ $customer->customer_organisation_code }}</td>
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
</div>
@endsection