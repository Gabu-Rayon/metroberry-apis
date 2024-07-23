@extends('layouts.app')

@section('title', 'Drivers')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Drivers</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('driver/create')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Add Driver
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
                                                        <th title="Name">Name</th>
                                                        <th title="Email">Email</th>
                                                        <th title="Phone">Phone</th>
                                                        <th title="Address">Address</th>
                                                        <th title="Vehicle">Vehicle</th>
                                                        <th title="Status">Status</th>
                                                        @if (\Auth::user()->role == 'admin')
                                                            <th title="Action" width="80">Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($drivers as $driver)
                                                        <tr>
                                                            <td>{{ $driver->user->name }}</td>
                                                            <td>{{ $driver->user->email }}</td>
                                                            <td>{{ $driver->user->phone }}</td>
                                                            <td>{{ $driver->user->address }}</td>
                                                            <td class="text-center">
                                                                {{ $driver->vehicle ? $driver->vehicle->plate_number : '-' }}
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $license = $driver->driverLicense;
                                                                    $psvBadge = $driver->psvBadge;

                                                                    if (!$license) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Missing License';
                                                                    } elseif ($license && !$license->verified) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Unverified License';
                                                                    } elseif ($psvBadge && !$psvBadge->verified) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Unverified PSV Badge';
                                                                    } elseif (!$psvBadge) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Missing PSV Badge';
                                                                    } else {
                                                                        if ($driver->status == 'inactive') {
                                                                            $badgeClass = 'badge bg-warning text-dark';
                                                                            $badgeText = 'Pending Verification';
                                                                        } else {
                                                                            $badgeClass = 'badge bg-success';
                                                                            $badgeText = 'Valid';
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="{{ $badgeClass }}">{{ $badgeText }}</span>
                                                            </td>
                                                            @if (\Auth::user()->role == 'admin')
                                                                <td class="text-center">
                                                                    @if (\Auth::user()->can('edit driver'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-primary"
                                                                            onclick="axiosModal('driver/{{ $driver->id }}/edit')"
                                                                            title="Edit Driver">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    @endif
                                                                    <span class='m-1'></span>

                                                                    @if ($driver->status == 'active')
                                                                        @if (\Auth::user()->can('edit driver'))
                                                                            <a href="javascript:void(0);"
                                                                                class="btn btn-sm btn-success"
                                                                                onclick="axiosModal('driver/{{ $driver->id }}/deactivate')"
                                                                                title="Dectivate Driver">
                                                                                <i class="fas fa-toggle-on"></i>
                                                                            </a>
                                                                        @endif
                                                                    @else
                                                                        @if (\Auth::user()->can('edit driver'))
                                                                            <a href="javascript:void(0);"
                                                                                class="btn btn-sm btn-secondary"
                                                                                onclick="axiosModal('driver/{{ $driver->id }}/activate')"
                                                                                title="Activate Driver">
                                                                                <i class="fas fa-toggle-off"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                    @if (\Auth::user()->can('edit driver'))
                                                                        <span class='m-1'></span>
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-danger"
                                                                            onclick="deleteDriver({{ $driver->id }})"
                                                                            title="Delete Driver">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if (!$driver->vehicle && $driver->status == 'active')
                                                                        <span class='m-1'></span>
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-info"
                                                                            onclick="axiosModal('{{ route('driver.vehicle.assign', $driver->id) }}')"
                                                                            title="Assign Vehicle">
                                                                            <i class="fa-solid fa-key"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            @endif
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

        {{-- Delete Modal --}}
        <div class="modal fade" id="delete-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Are you sure you want to delete this driver? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>

@endsection
