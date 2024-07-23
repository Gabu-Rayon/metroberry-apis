@extends('layouts.app')

@section('title', 'Licenses')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Licenses</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('license/create')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Add License
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
                                                        <th title="Name">License No</th>
                                                        <th title="Address">Driver</th>
                                                        <th title="Email">Issue Date</th>
                                                        <th title="Phone">Expiry Date</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($licenses as $license)
                                                        <tr>
                                                            <td>{{ $license->driving_license_no }}</td>
                                                            <td>{{ $license->driver->user->name }}</td>
                                                            <td>{{ $license->driving_license_date_of_issue }}</td>
                                                            <td>{{ $license->driving_license_date_of_expiry }}</td>
                                                            <td>
                                                                @php
                                                                    $frontPage = $license->driving_license_avatar_front;
                                                                    $backPage = $license->driving_license_avatar_back;

                                                                    // First, check for missing documents.
                                                                    if (!$frontPage || !$backPage) {
                                                                        $badgeClass = 'badge bg-danger'; // Red badge indicates missing documents.
                                                                        $badgeText = 'Missing Documents';
                                                                    } else {
                                                                        // Proceed only if both front and back pages are available.
                                                                        $expiryDate = \Carbon\Carbon::parse(
                                                                            $license->driving_license_date_of_expiry,
                                                                        );
                                                                        $today = \Carbon\Carbon::today();
                                                                        $isExpired = $today->lt($expiryDate);

                                                                        $daysUntilExpiry = $isExpired
                                                                            ? 0
                                                                            : $today->diffInDays($expiryDate, false);

                                                                        // Determine badge color and text based on days until expiry and verification status.
                                                                        if ($daysUntilExpiry < 0) {
                                                                            $badgeClass = 'badge bg-danger';
                                                                            $badgeText = 'Expired';
                                                                        } elseif (
                                                                            $daysUntilExpiry <= 30 &&
                                                                            !$license->verified
                                                                        ) {
                                                                            $badgeClass = 'badge bg-warning text-dark'; // Yellow badge for pending verification.
                                                                            $badgeText = 'Pending Verification';
                                                                        } elseif (
                                                                            $daysUntilExpiry > 30 &&
                                                                            !$license->verified
                                                                        ) {
                                                                            $badgeClass = 'badge bg-warning text-dark'; // Yellow badge for pending verification.
                                                                            $badgeText = 'Pending Verification';
                                                                        } else {
                                                                            $badgeClass = 'badge bg-success';
                                                                            $badgeText = 'Valid';
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="{{ $badgeClass }}">{{ $badgeText }}</span>
                                                            </td>
                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('license/{{ $license->id }}/edit')"
                                                                    title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if (!$license->verified)
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-secondary"
                                                                        onclick="axiosModal('license/{{ $license->id }}/verify')"
                                                                        title="Verify">
                                                                        <i class="fas fa-toggle-off"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-success"
                                                                        onclick="axiosModal('license/{{ $license->id }}/revoke')"
                                                                        title="Suspend">
                                                                        <i class="fas fa-toggle-on"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('license/{{ $license->id }}/delete')"
                                                                    title="Delete">
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
                    <div class="overlay"></div>
                    @include('components.footer')
                </div>
            </div>
        </div>
    </body>
@endsection
