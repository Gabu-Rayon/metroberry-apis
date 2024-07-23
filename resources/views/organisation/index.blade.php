@extends('layouts.app')

@section('title', 'Organisations')
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
                                                <h6 class="fs-17 fw-semi-bold mb-0">Organisations</h6>
                                            </div>
                                            <div class="text-end">
                                                <div class="actions">
                                                    <div class="accordion-header d-flex justify-content-end align-items-center"
                                                        id="flush-headingOne">
                                                        @if (\Auth::user()->can('create organisation'))
                                                            <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                                onclick="axiosModal('organisation/create')">
                                                                <i class="fa fa-plus"></i>
                                                                &nbsp;
                                                                Add Organisation
                                                            </a>
                                                        @endif
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
                                                        <th title="Organisation">Code</th>
                                                        <th title="Status">Status</th>
                                                        <th title="Action" width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($organisations as $organisation)
                                                        <tr>
                                                            <td>{{ $organisation->user->name }}</td>
                                                            <td>{{ $organisation->user->email }}</td>
                                                            <td>{{ $organisation->user->phone }}</td>
                                                            <td>{{ $organisation->user->address }}</td>
                                                            <td>{{ $organisation->organisation_code }}</td>
                                                            <td>
                                                                @if ($organisation->status == 'active')
                                                                    <span class="badge bg-success">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger">Inactive</span>
                                                                @endif
                                                            </td>
                                                            <td class="d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                                                    onclick="axiosModal('organisation/{{ $organisation->id }}/edit')">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <span class='m-1'></span>
                                                                @if ($organisation->status == 'active')
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-success"
                                                                        onclick="axiosModal('organisation/{{ $organisation->id }}/deactivate')"
                                                                        title="Dectivate Organisation">
                                                                        <i class="fas fa-toggle-on"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-secondary"
                                                                        onclick="axiosModal('organisation/{{ $organisation->id }}/activate')"
                                                                        title="Activate Organisation">
                                                                        <i class="fas fa-toggle-off"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                    onclick="axiosModal('organisation/{{ $organisation->id }}/delete')">
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

        <!-- Delete Modal -->
        <div class="modal fade" id="delete-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Organisation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Are you sure you want to delete this organisation? This action cannot be undone.</p>
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
            function deleteOrganisation(organisationId) {
                // Set the delete form action dynamically
                var form = document.getElementById('delete-modal-form');
                form.action = '/organisation/' + organisationId + '/delete';

                // Open the delete modal
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
