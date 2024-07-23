@extends('layouts.app')

@section('title', 'Vehicle Services')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Vehicle Services</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('maintenance.service.create') }}')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
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
                                                            <th title="Vehicle">Vehicle</th>
                                                            <th title="Category">Category</th>
                                                            <th title="Date">Date</th>
                                                            <th title="Cost">Cost</th>
                                                            <th title="Status">Status</th>
                                                            <th title="Action">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($maintenanceServices as $service)
                                                            <tr>
                                                                <td>{{ $service->vehicle->plate_number }}</td>
                                                                <td>{{ $service->serviceCategory->name }}</td>
                                                                <td>{{ $service->service_date }}</td>
                                                                <td>KES {{ $service->service_cost }}</td>
                                                                <td>
                                                                    @if ($service->service_status == 'pending')
                                                                        <span class="badge bg-secondary">Pending</span>
                                                                    @elseif ($service->service_status == 'billed')
                                                                        <span class="badge bg-success">Billed</span>
                                                                    @elseif ($service->service_status == 'approved')
                                                                        <span class="badge bg-info">Approved</span>
                                                                    @elseif ($service->service_status == 'rejected')
                                                                        <span class="badge bg-danger">Rejected</span>
                                                                    @elseif ($service->service_status == 'paid')
                                                                        <span class="badge bg-danger">paid</span>
                                                                    @elseif ($service->service_status == 'partially paid')
                                                                        <span class="badge bg-danger">partially paid</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Invalid Status</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($service->service_status == 'pending')
                                                                        <a href="javascript:void(0);"
                                                                            onclick="axiosModal('{{ route('maintenance.service.approve', $service->id) }}')"
                                                                            class="btn btn-primary btn-sm" title="Approve">
                                                                            <i class="fa-solid fa-thumbs-up"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0);"
                                                                            onclick="axiosModal('{{ route('maintenance.service.reject', $service->id) }}')"
                                                                            class="btn btn-danger btn-sm" title="Reject">
                                                                            <i class="fa-solid fa-ban"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if ($service->service_status == 'approved')
                                                                        <a href="javascript:void(0);"
                                                                            onclick="axiosModal('{{ route('maintenance.service.bill', $service->id) }}')"
                                                                            class="btn btn-primary btn-sm" title="Bill">
                                                                            <i class="fa-solid fa-money-bill"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if (in_array($service->service_status, ['billed', 'paid', 'partially paid']))
                                                                        <a href="{{ route('maintenance.service.payment.checkout', ['id' => $service->id]) }}"
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
                                            <div id="page-axios-data" data-table-id="#driver-table"></div>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
