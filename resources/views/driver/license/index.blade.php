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
                                                <div class="accordion-header d-flex justify-content-end align-items-center" id="flush-headingOne">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('license/create')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Add License
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm mx-2" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                        <i class="fas fa-filter"></i>
                                                        Filter
                                                    </button>
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
                                                                    <label for="license_no"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">License No</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control"
                                                                            id="license_no" name="license_no"
                                                                            placeholder="License No">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 d-flex align-items-center">
                                                                <button class="btn btn-success me-2 search-btn"
                                                                    type="button">Search</button>
                                                                <button class="btn btn-danger me-2 reset-btn"
                                                                    type="button">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                            }
                                                            
                                                            else {
                                                                // Proceed only if both front and back pages are available.
                                                                $expiryDate = \Carbon\Carbon::parse($license->driving_license_date_of_expiry);
                                                                $today = \Carbon\Carbon::today();
                                                                $isExpired = $today->lt($expiryDate);
                                                    
                                                                $daysUntilExpiry = $isExpired ? 0 : $today->diffInDays($expiryDate, false);
                                                    
                                                                // Determine badge color and text based on days until expiry and verification status.
                                                                if ($daysUntilExpiry < 0) {
                                                                    $badgeClass = 'badge bg-danger';
                                                                    $badgeText = 'Expired';
                                                                } elseif ($daysUntilExpiry <= 30 && !$license->verified) {
                                                                    $badgeClass = 'badge bg-warning text-dark'; // Yellow badge for pending verification.
                                                                    $badgeText = 'Pending Verification';
                                                                } elseif ($daysUntilExpiry > 30 && !$license->verified) {
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
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('license/{{ $license->id }}/edit')" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <span class='m-1'></span>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteLicense({{ $license->id }})" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <span class='m-1'></span>
                                                        @if (!$license->verified)
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary" onclick="axiosModal('license/{{ $license->id }}/verify')" title="Verify">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="revokeLicense({{ $license->id }})" title="Revoke">
                                                                <i class="fas fa-toggle-on"></i>
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

    <!-- Delete Modal -->
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

    <!-- JavaScript -->
    <script>
        function deleteLicense(licenseId) {
            var form = document.getElementById('delete-modal-form');
            form.action = '/driver/license/' + licenseId + '/delete';

            var modal = new bootstrap.Modal(document.getElementById('delete-modal'));
            modal.show();
        }

        function confirmDelete() {
            // Submit the delete form
            var form = document.getElementById('delete-modal-form');
            form.submit();
        }
    </script>

</body>

@endsection
