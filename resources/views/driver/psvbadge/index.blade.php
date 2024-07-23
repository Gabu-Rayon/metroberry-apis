@extends('layouts.app')

@section('title', 'PSV Badges')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">PSV Badges</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('psvbadge/create')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Add PSV Badge
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
                                                        <th title="Name">Badge No</th>
                                                        <th title="Address">Driver</th>
                                                        <th title="Email">Issue Date</th>
                                                        <th title="Phone">Expiry Date</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($psvbadges as $psvbadge)
                                                        <tr>
                                                            <td>{{ $psvbadge->psv_badge_no }}</td>
                                                            <td>{{ $psvbadge->driver->user->name }}</td>
                                                            <td>{{ $psvbadge->psv_badge_date_of_issue }}</td>
                                                            <td>{{ $psvbadge->psv_badge_date_of_expiry }}</td>
                                                            <td>
                                                                @php
                                                                    $avatar = $psvbadge->psv_badge_avatar;

                                                                    if (!$avatar) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Missing Documents';
                                                                    } else {
                                                                        $expiryDate = \Carbon\Carbon::parse(
                                                                            $psvbadge->psv_badge_date_of_expiry,
                                                                        );
                                                                        $today = \Carbon\Carbon::today();
                                                                        $daysUntilExpiry = $today->diffInDays(
                                                                            $expiryDate,
                                                                            false,
                                                                        );
                                                                        $isExpired = $daysUntilExpiry < 0;

                                                                        Log::info(
                                                                            'Days until expiry: ' . $daysUntilExpiry,
                                                                        );

                                                                        if ($isExpired) {
                                                                            $badgeClass = 'badge bg-danger';
                                                                            $badgeText = 'Expired';
                                                                        } elseif (
                                                                            $daysUntilExpiry > 0 &&
                                                                            $daysUntilExpiry <= 30
                                                                        ) {
                                                                            if (!$psvbadge->verified) {
                                                                                $badgeClass =
                                                                                    'badge bg-warning text-dark';
                                                                                $badgeText = 'Pending Verification';
                                                                            } else {
                                                                                $badgeClass =
                                                                                    'badge bg-warning text-dark';
                                                                                $badgeText = 'Expires Soon';
                                                                            }
                                                                        } elseif (!$psvbadge->verified) {
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


                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('psvbadge/{{ $psvbadge->id }}/edit')"
                                                                    title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if (!$psvbadge->verified)
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-secondary"
                                                                        onclick="axiosModal('psvbadge/{{ $psvbadge->id }}/verify')"
                                                                        title="Verify">
                                                                        <i class="fas fa-toggle-off"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-success"
                                                                        onclick="axiosModal('psvbadge/{{ $psvbadge->id }}/revoke')"
                                                                        title="Suspend">
                                                                        <i class="fas fa-toggle-on"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('psvbadge/{{ $psvbadge->id }}/delete')"
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
