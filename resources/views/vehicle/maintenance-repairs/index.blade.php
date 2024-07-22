@extends('layouts.app')

@section('title', 'Vehicle Repairs')
@section('content')

    <body class="fixed sidebar-mini">
        @include('components.preloader')
        <div id="app">
            <div class="wrapper">
                @include('components.sidebar.sidebar')
                <div class="content-wrapper">
                    <div class="main-content">
                        @include('components.navbar')
                        <div class="body-content">
                            <div class="tile">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-17 fw-semi-bold mb-0">Vehicle Repairs</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('{{ route('maintenance.repair.create') }}')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Repair Vehicle
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="driver-table">
                                                <thead>
                                                    <tr>
                                                        <th title="Vehicle">Vehicle</th>
                                                        <th title="Part">Part</th>
                                                        <th title="Type">Type</th>
                                                        <th title="Amount">Amount</th>
                                                        <th title="Cost">Cost</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($maintenanceRepairs as $maintenanceRepair)
                                                        <tr>
                                                            <td>{{ $maintenanceRepair->vehicle->plate_number }}</td>
                                                            <td>{{ $maintenanceRepair->part->name }}</td>
                                                            <td>{{ $maintenanceRepair->repair_type }}</td>
                                                            <td>{{ $maintenanceRepair->amount }}</td>
                                                            <td>{{ $maintenanceRepair->repair_cost }}</td>
                                                            <td>
                                                                @if ($maintenanceRepair->repair_status == 'pending')
                                                                    <span class="badge bg-secondary">Pending</span>
                                                                @elseif ($maintenanceRepair->repair_status == 'billed')
                                                                    <span class="badge bg-success">Billed</span>
                                                                @elseif ($maintenanceRepair->repair_status == 'approved')
                                                                    <span class="badge bg-info">Approved</span>
                                                                @elseif ($maintenanceRepair->repair_status == 'rejected')
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @elseif ($service->repair_status == 'paid')
                                                                    <span class="badge bg-danger">paid</span>
                                                                @elseif ($service->repair_status == 'partially paid')
                                                                    <span class="badge bg-danger">partially paid</span>
                                                                @else
                                                                    <span class="badge bg-warning">Invalid Status</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($maintenanceRepair->repair_status == 'pending' || $maintenanceRepair->repair_status == 'approved')
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.edit', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-info btn-sm" title="Edit">
                                                                        <i class="fa-solid fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($maintenanceRepair->repair_status == 'billed' || $maintenanceRepair->repair_status == 'rejected')
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.redo-repair', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-secondary btn-sm"
                                                                        title="Redo Repair">
                                                                        <i class="fa-solid fa-rotate-right"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($maintenanceRepair->repair_status == 'pending')
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.approve.form', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-primary btn-sm" title="Approve">
                                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.reject', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-warning btn-sm" title="Reject">
                                                                        <i class="fa-solid fa-ban"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($maintenanceRepair->repair_status == 'approved')
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.bill.form', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-primary btn-sm" title="Bill">
                                                                        <i class="fa-solid fa-money-bill"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($maintenanceRepair->repair_status == 'pending' || $maintenanceRepair->repair_status == 'approved')
                                                                    <a href="javascript:void(0);"
                                                                        onclick="axiosModal('{{ route('maintenance.repair.delete', $maintenanceRepair->id) }}')"
                                                                        class="btn btn-danger btn-sm" title="Delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @endif

                                                                @if (in_array($maintenanceRepair->repair_status, ['billed', 'paid', 'partially paid']))
                                                                    <a href="{{ route('maintenance.repair.payment.checkout', ['id' => $maintenanceRepair->id]) }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="Checkout to Pay Vehicle maintenance service charges.">
                                                                        <small><i
                                                                                class="fa-solid fa-money-bill"></i></small>
                                                                    </a>
                                                                @endif

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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
        </div>

    </body>

@endsection
