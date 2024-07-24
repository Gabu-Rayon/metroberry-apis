@extends('layouts.app')

@section('title', 'Refueling List')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Refueling List</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <a class="btn btn-success" href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('refueling.create') }}')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Create
                                                    </a>
                                                </div>
                                            </div </div>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table" id="driver-table">
                                                        <thead>
                                                            <tr>
                                                                <th title="Vehicle">Vehicle</th>
                                                                <th title="Station">Station</th>
                                                                <th title="Volume">Volume</th>
                                                                <th title="Cost">Cost</th>
                                                                <th title="Status">Status</th>
                                                                <th title="Action" width="80">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($refuelings as $refueling)
                                                                <tr>
                                                                    <td>{{ $refueling->vehicle->plate_number }}</td>
                                                                    <td>{{ $refueling->refuellingStation->user->name }}</td>
                                                                    <td>{{ $refueling->refuelling_volume }}</td>
                                                                    <td>{{ $refueling->refuelling_cost }}</td>
                                                                    <td class="text-center">
                                                                        @if ($refueling->status == 'pending')
                                                                            <span class="badge bg-secondary">Pending</span>
                                                                        @elseif ($refueling->status == 'billed')
                                                                            <span class="badge bg-success">Billed</span>
                                                                        @elseif ($refueling->status == 'approved')
                                                                            <span class="badge bg-info">Approved</span>
                                                                        @elseif ($refueling->status == 'rejected')
                                                                            <span class="badge bg-danger">Rejected</span>
                                                                        @else
                                                                            <span class="badge bg-warning">Invalid
                                                                                Status</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($refueling->status == 'pending' || $refueling->status == 'approved')
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.edit', $refueling->id) }}')"
                                                                                class="btn btn-info btn-sm" title="Edit">
                                                                                <i class="fa-solid fa-edit"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if ($refueling->status == 'billed' || $refueling->status == 'rejected')
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.redo-refuel', $refueling->id) }}')"
                                                                                class="btn btn-secondary btn-sm"
                                                                                title="Redo Refuel">
                                                                                <i class="fa-solid fa-rotate-right"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if ($refueling->status == 'pending')
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.approve', $refueling->id) }}')"
                                                                                class="btn btn-primary btn-sm"
                                                                                title="Approve">
                                                                                <i class="fa-solid fa-thumbs-up"></i>
                                                                            </a>
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.reject', $refueling->id) }}')"
                                                                                class="btn btn-warning btn-sm"
                                                                                title="Reject">
                                                                                <i class="fa-solid fa-ban"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if ($refueling->status == 'approved')
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.bill', $refueling->id) }}')"
                                                                                class="btn btn-primary btn-sm"
                                                                                title="Bill">
                                                                                <i class="fa-solid fa-money-bill"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if ($refueling->status == 'pending' || $refueling->status == 'approved')
                                                                            <a href="javascript:void(0);"
                                                                                onclick="axiosModal('{{ route('refueling.delete', $refueling->id) }}')"
                                                                                class="btn btn-danger btn-sm"
                                                                                title="Delete">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
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
                                    <p>Are you sure you want to delete this item? you won t be able to revert this item
                                        back!
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
