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
                                            action="https://vms.bdtask-demoserver.com/admin/role" method="POST"
                                            class="needs-validation" enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="n2ZEssr5XnOCkUOLoxI4suHuVo07cXoBJLmgq6Iz" autocomplete="off">
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
                                                                        Setting
                                                                    </legend>
                                                                    <div class="row py-3">

                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="language_setting_management" name="permissions[48]" value="48">
                                                                                <label class="form-check-label" for="language_setting_management">
                                                                                    Language Setting Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        User
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="permission_management"
                                                                                    name="permissions[44]"
                                                                                    value="44">
                                                                                <label class="form-check-label"
                                                                                    for="permission_management">
                                                                                    Permission Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="role_management"
                                                                                    name="permissions[43]"
                                                                                    value="43">
                                                                                <label class="form-check-label"
                                                                                    for="role_management">
                                                                                    Role Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="user_management"
                                                                                    name="permissions[42]"
                                                                                    value="42">
                                                                                <label class="form-check-label"
                                                                                    for="user_management">
                                                                                    User Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Report
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="maintenance_report"
                                                                                    name="permissions[41]"
                                                                                    value="41">
                                                                                <label class="form-check-label"
                                                                                    for="maintenance_report">
                                                                                    Maintenance Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="expense_report"
                                                                                    name="permissions[40]"
                                                                                    value="40">
                                                                                <label class="form-check-label"
                                                                                    for="expense_report">
                                                                                    Expense Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="purchase_report"
                                                                                    name="permissions[39]"
                                                                                    value="39">
                                                                                <label class="form-check-label"
                                                                                    for="purchase_report">
                                                                                    Purchase Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="refuel_requisition_report"
                                                                                    name="permissions[38]"
                                                                                    value="38">
                                                                                <label class="form-check-label"
                                                                                    for="refuel_requisition_report">
                                                                                    Refuel Requisition Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="pickdrop_requisition_report"
                                                                                    name="permissions[37]"
                                                                                    value="37">
                                                                                <label class="form-check-label"
                                                                                    for="pickdrop_requisition_report">
                                                                                    Pickdrop Requisition Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_requisition_report"
                                                                                    name="permissions[36]"
                                                                                    value="36">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_requisition_report">
                                                                                    Vehicle Requisition Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_report"
                                                                                    name="permissions[35]"
                                                                                    value="35">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_report">
                                                                                    Vehicle Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="driver_report"
                                                                                    name="permissions[34]"
                                                                                    value="34">
                                                                                <label class="form-check-label"
                                                                                    for="driver_report">
                                                                                    Driver Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="employee_report"
                                                                                    name="permissions[33]"
                                                                                    value="33">
                                                                                <label class="form-check-label"
                                                                                    for="employee_report">
                                                                                    Employee Report
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="report_management"
                                                                                    name="permissions[32]"
                                                                                    value="32">
                                                                                <label class="form-check-label"
                                                                                    for="report_management">
                                                                                    Report Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Purchase
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="purchase_management"
                                                                                    name="permissions[31]"
                                                                                    value="31">
                                                                                <label class="form-check-label"
                                                                                    for="purchase_management">
                                                                                    Purchase Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Maintenance
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_maintenance_management"
                                                                                    name="permissions[30]"
                                                                                    value="30">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_maintenance_management">
                                                                                    Vehicle Maintenance Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Inventory
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_stock_management"
                                                                                    name="permissions[29]"
                                                                                    value="29">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_stock_management">
                                                                                    Inventory Stock Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="trip_type_management"
                                                                                    name="permissions[28]"
                                                                                    value="28">
                                                                                <label class="form-check-label"
                                                                                    for="trip_type_management">
                                                                                    Trip Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="expense_type_management"
                                                                                    name="permissions[27]"
                                                                                    value="27">
                                                                                <label class="form-check-label"
                                                                                    for="expense_type_management">
                                                                                    Expense Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="expense_management"
                                                                                    name="permissions[26]"
                                                                                    value="26">
                                                                                <label class="form-check-label"
                                                                                    for="expense_management">
                                                                                    Expense Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_vendor_management"
                                                                                    name="permissions[25]"
                                                                                    value="25">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_vendor_management">
                                                                                    Inventory Vendor Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_parts_usage_management"
                                                                                    name="permissions[24]"
                                                                                    value="24">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_parts_usage_management">
                                                                                    Inventory Parts Usage Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_parts_management"
                                                                                    name="permissions[23]"
                                                                                    value="23">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_parts_management">
                                                                                    Inventory Parts Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_location_management"
                                                                                    name="permissions[22]"
                                                                                    value="22">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_location_management">
                                                                                    Inventory Location Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="inventory_category_management"
                                                                                    name="permissions[21]"
                                                                                    value="21">
                                                                                <label class="form-check-label"
                                                                                    for="inventory_category_management">
                                                                                    Inventory Category Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Refueling
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="refueling_requisition_management"
                                                                                    name="permissions[20]"
                                                                                    value="20">
                                                                                <label class="form-check-label"
                                                                                    for="refueling_requisition_management">
                                                                                    Refueling Requisition Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="refueling_management"
                                                                                    name="permissions[19]"
                                                                                    value="19">
                                                                                <label class="form-check-label"
                                                                                    for="refueling_management">
                                                                                    Refueling Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="fuel_station_management"
                                                                                    name="permissions[18]"
                                                                                    value="18">
                                                                                <label class="form-check-label"
                                                                                    for="fuel_station_management">
                                                                                    Fuel Station Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="fuel_type_management"
                                                                                    name="permissions[17]"
                                                                                    value="17">
                                                                                <label class="form-check-label"
                                                                                    for="fuel_type_management">
                                                                                    Fuel Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Insurance
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="insurance_management"
                                                                                    name="permissions[16]"
                                                                                    value="16">
                                                                                <label class="form-check-label"
                                                                                    for="insurance_management">
                                                                                    Insurance Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_insurance_recurring_period_management"
                                                                                    name="permissions[15]"
                                                                                    value="15">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_insurance_recurring_period_management">
                                                                                    Vehicle Insurance Recurring Period
                                                                                    Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_insurance_company_management"
                                                                                    name="permissions[14]"
                                                                                    value="14">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_insurance_company_management">
                                                                                    Vehicle Insurance Company Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Requisition
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="pick_drop_requisition"
                                                                                    name="permissions[13]"
                                                                                    value="13">
                                                                                <label class="form-check-label"
                                                                                    for="pick_drop_requisition">
                                                                                    Pick Drop Requisition
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_route_management"
                                                                                    name="permissions[12]"
                                                                                    value="12">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_route_management">
                                                                                    Vehicle Route Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_requisition_purpose_management"
                                                                                    name="permissions[11]"
                                                                                    value="11">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_requisition_purpose_management">
                                                                                    Vehicle Requisition Purpose
                                                                                    Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_requisition_management"
                                                                                    name="permissions[10]"
                                                                                    value="10">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_requisition_management">
                                                                                    Vehicle Requisition Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_requisition_type_management"
                                                                                    name="permissions[9]"
                                                                                    value="9">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_requisition_type_management">
                                                                                    Vehicle Requisition Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Vehicle Management
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="legal_document_management"
                                                                                    name="permissions[8]"
                                                                                    value="8">
                                                                                <label class="form-check-label"
                                                                                    for="legal_document_management">
                                                                                    Legal Document Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="document_type_management"
                                                                                    name="permissions[7]"
                                                                                    value="7">
                                                                                <label class="form-check-label"
                                                                                    for="document_type_management">
                                                                                    Document Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_ownership_type_management"
                                                                                    name="permissions[6]"
                                                                                    value="6">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_ownership_type_management">
                                                                                    Vehicle Ownership Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_rta_office_management"
                                                                                    name="permissions[5]"
                                                                                    value="5">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_rta_office_management">
                                                                                    Vehicle Rta Office Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_division_management"
                                                                                    name="permissions[4]"
                                                                                    value="4">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_division_management">
                                                                                    Vehicle Division Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_type_management"
                                                                                    name="permissions[3]"
                                                                                    value="3">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_type_management">
                                                                                    Vehicle Type Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="vehicle_management"
                                                                                    name="permissions[2]"
                                                                                    value="2">
                                                                                <label class="form-check-label"
                                                                                    for="vehicle_management">
                                                                                    Vehicle Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <legend>
                                                                        Employee
                                                                    </legend>
                                                                    <div class="row py-3">
                                                                        <div class="col-md-4 form-group">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" role="switch"
                                                                                    id="employee_management"
                                                                                    name="permissions[1]"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="employee_management">
                                                                                    Employee Management
                                                                                </label>
                                                                            </div>
                                                                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="delete-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
