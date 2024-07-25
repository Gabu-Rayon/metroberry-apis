@extends('layouts.app')

@section('title', 'Vehicle Inspection Certificates')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Vehicle  Insepction Certificate(s)</h6>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#inspectionModal">
                                                    <i class="fa-solid fa-user-plus"></i>&nbsp; Add Certificate
                                                </button>
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

        <div class="modal fade" id="inspectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('vehicle.inspection.certificate.create') }}" method="POST"
                    class="needs-validation modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add Inspection Certificate</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12 col-lg-6">

                                <div class="form-group row my-2">
                                    <label for="vehicle" class="col-sm-5 col-form-label">
                                        Vehicle
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select name="vehicle" class="form-control" id="vehicle" required>
                                            <option value="" disabled selected>Select a vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->make }}
                                                    {{ $vehicle->model }},
                                                    {{ $vehicle->plate_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="ntsa_inspection_certificate_date_of_issue" class="col-sm-5 col-form-label">
                                        Date of Issue
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="ntsa_inspection_certificate_date_of_issue" class="form-control"
                                            type="date" id="ntsa_inspection_certificate_date_of_issue" required />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="ntsa_inspection_certificate_no" class="col-sm-5 col-form-label">
                                        Certificate No
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="ntsa_inspection_certificate_no" class="form-control" type="text"
                                            placeholder="Certificate No" id="ntsa_inspection_certificate_no" required />
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-lg-6">

                                <div class="form-group row my-2">
                                    <div class="col-sm-5 col-form-label">
                                        Requested By
                                        <i class="text-danger">*</i>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-control">{{ auth()->user()->name }}</div>
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="ntsa_inspection_certificate_date_of_expiry"
                                        class="col-sm-5 col-form-label">
                                        Date of Expiry
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="ntsa_inspection_certificate_date_of_expiry" class="form-control"
                                            type="date" id="ntsa_inspection_certificate_date_of_expiry" required />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="avatar" class="col-sm-5 col-form-label">
                                        Certificate Copy
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="avatar" class="form-control" type="file" accept="image/*"
                                            id="avatar" required />
                                        <img id="avatar_preview" class="form-control mt-2" style="display: none;" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection
