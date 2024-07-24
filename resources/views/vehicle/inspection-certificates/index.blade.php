@extends('layouts.app')

@section('title', 'Certificates')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Certificates</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                            onclick="axiosModal('{{ route('vehicle.inspection.certificate.create') }}')">
                                                            <i class="fa fa-plus"></i>
                                                            &nbsp;
                                                            Add Certificate
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
                                                        <th title="Name">Certificate No</th>
                                                        <th title="Address">Vehicle</th>
                                                        <th title="Email">Issue Date</th>
                                                        <th title="Phone">Expiry Date</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($certificates as $certificate)
                                                        {{ Log::info('Certificate') }}
                                                        {{ Log::info($certificate) }}
                                                        <tr>
                                                            <td>{{ $certificate->ntsa_inspection_certificate_no }}</td>
                                                            <td>{{ $certificate->vehicle->plate_number }}</td>
                                                            <td>{{ $certificate->ntsa_inspection_certificate_date_of_issue }}
                                                            </td>
                                                            <td>{{ $certificate->ntsa_inspection_certificate_date_of_expiry }}
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $avatar =
                                                                        $certificate->ntsa_inspection_certificate_avatar;

                                                                    if (!$avatar) {
                                                                        $badgeClass = 'badge bg-danger';
                                                                        $badgeText = 'Missing Document';
                                                                    } else {
                                                                        $expiryDate = \Carbon\Carbon::parse(
                                                                            $certificate->ntsa_inspection_certificate_date_of_expiry,
                                                                        );
                                                                        $today = \Carbon\Carbon::today();

                                                                        // Determine if the certificate has expired
                                                                        $isExpired = $today->gt($expiryDate); // Changed to gt for correct comparison

                                                                        // Calculate days until expiry if the certificate has not expired
                                                                        $daysUntilExpiry = $isExpired
                                                                            ? 0
                                                                            : $today->diffInDays($expiryDate, false);

                                                                        Log::info(
                                                                            'Days until expiry: ' . $daysUntilExpiry,
                                                                        );

                                                                        if ($isExpired) {
                                                                            $badgeClass = 'badge bg-danger';
                                                                            $badgeText = 'Expired';
                                                                        } elseif (
                                                                            $daysUntilExpiry <= 30 &&
                                                                            $certificate->verified
                                                                        ) {
                                                                            $badgeClass = 'badge bg-warning text-dark';
                                                                            $badgeText = 'Expires Soon';
                                                                        } elseif (
                                                                            $daysUntilExpiry > 30 &&
                                                                            $certificate->verified
                                                                        ) {
                                                                            $badgeClass = 'badge bg-success';
                                                                            $badgeText = 'Valid';
                                                                        } else {
                                                                            $badgeClass = 'badge bg-warning text-dark';
                                                                            $badgeText = 'Pending Verification';
                                                                        }
                                                                    }
                                                                @endphp
                                                                <span class="{{ $badgeClass }}">{{ $badgeText }}</span>
                                                            </td>

                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('{{ route('vehicle.inspection.certificate.edit', $certificate->id) }}')"
                                                                    title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if (!$certificate->verified)
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-secondary"
                                                                        onclick="axiosModal('{{ route('vehicle.inspection.certificate.verify', $certificate->id) }}')"
                                                                        title="Verify">
                                                                        <i class="fas fa-toggle-off"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-success"
                                                                        onclick="axiosModal('{{ route('vehicle.inspection.certificate.suspend', $certificate->id) }}')"
                                                                        title="Suspend">
                                                                        <i class="fas fa-toggle-on"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('{{ route('vehicle.inspection.certificate.delete', $certificate->id) }}')"
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
