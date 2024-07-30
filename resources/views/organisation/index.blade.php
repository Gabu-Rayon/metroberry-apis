@extends('layouts.app')

@section('title', 'Organisations')
@section('content')

    <head>
        <style>
            .generate-btn-container {
                position: absolute;
                top: 0;
                right: 0;
                transform: translateY(-50%);
                cursor: pointer;
            }

            .generate-btn {
                padding: 5px 10px;
                font-size: 0.8em;
            }
        </style>
    </head>

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
                                                        @if (Auth::user()->can('export organisations'))
                                                            <a class="btn btn-success btn-sm"
                                                                href={{ route('organisation.export') }} title="Export">
                                                                <i class="fa-solid fa-file-export"></i>
                                                                &nbsp;
                                                                Export
                                                            </a>
                                                        @endif
                                                        <span class="m-1"></span>
                                                        @if (Auth::user()->can('import organisations'))
                                                            <a class="btn btn-success btn-sm" href="javascript:void(0);"
                                                                onclick="axiosModal('{{ route('organisation.import.file') }}')"
                                                                title="Import From csv excel file">
                                                                <i class="fa-solid fa-file-arrow-up"></i>&nbsp; Import
                                                            </a>
                                                        @endif
                                                        <span class="m-1"></span>
                                                        @if (\Auth::user()->can('create organisation'))
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#organisationModal">
                                                                <i class="fa-solid fa-user-plus"></i>&nbsp;
                                                                Add Organisation
                                                            </button>
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
                                                                @if (\Auth::user()->can('edit organisation'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-primary"
                                                                        onclick="axiosModal('organisation/{{ $organisation->id }}/edit')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                                <span class='m-1'></span>
                                                                @if ($organisation->status == 'active')
                                                                    @if (\Auth::user()->can('deactivate organisation'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-success"
                                                                            onclick="axiosModal('organisation/{{ $organisation->id }}/deactivate')"
                                                                            title="Dectivate Organisation">
                                                                            <i class="fas fa-toggle-on"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    @if (\Auth::user()->can('activate organisation'))
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm btn-secondary"
                                                                            onclick="axiosModal('organisation/{{ $organisation->id }}/activate')"
                                                                            title="Activate Organisation">
                                                                            <i class="fas fa-toggle-off"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <span class='m-1'></span>
                                                                @if (\Auth::user()->can('delete organisation'))
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="axiosModal('organisation/{{ $organisation->id }}/delete')">
                                                                        <i class="fas fa-trash"></i>
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

        <div class="modal fade" id="organisationModal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('organisation.create') }}" method="POST" class="needs-validation modal-content"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header my-3 p-2 border-bottom">
                        <h4>Add Organisation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">

                                <div class="form-group row my-2">
                                    <label for="name" class="col-sm-5 col-form-label">
                                        Name
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="name" class="form-control" type="text" placeholder="Name"
                                            id="name" required value="{{ old('name') }}" />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="phone" class="col-sm-5 col-form-label">
                                        Phone
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="phone" class="form-control" type="text" placeholder="Phone"
                                            id="phone" required value="{{ old('phone') }}" />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="organisation_code" class="col-sm-5 col-form-label">
                                        Organisation Code
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="organisation_code" class="form-control" type="text"
                                            placeholder="Organisation Code" id="organisation_code"
                                            value="{{ old('organisation_code') }}" />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="logo" class="col-sm-5 col-form-label">
                                        Logo
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="logo" class="form-control" type="file" placeholder="Logo"
                                            id="logo" value="{{ old('logo') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group row my-2">
                                    <label for="email" class="col-sm-5 col-form-label">
                                        Email
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="email" class="form-control" type="email" placeholder="Email"
                                            id="email" value="{{ old('email') }}" required />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="address" class="col-sm-5 col-form-label">
                                        Address
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="address" class="form-control" type="text" placeholder="Address"
                                            id="address" value="{{ old('address') }}" required />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="organisation_certificate" class="col-sm-5 col-form-label">
                                        Certificate of Organisation
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input name="organisation_certificate" class="form-control" type="file"
                                            placeholder="Certificate of Organisation" id="organisation_certificate"
                                            required value="{{ old('organisation_certificate') }}" />
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="password" class="col-sm-5 col-form-label">
                                        Password
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7 position-relative">
                                        <input name="password" class="form-control" type="password"
                                            placeholder="Password" id="password" readonly required />
                                        <div class="generate-btn-container">
                                            <span class="input-group-text generate-btn" onclick="generatePassword()"
                                                style="font-size: smaller;">Generate</span>
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
                        <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form"
                            method="POST">
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

            function generatePassword() {
                var length = 12,
                    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=",
                    password = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                    password += charset.charAt(Math.floor(Math.random() * n));
                }
                document.getElementById("password").value = password;
            }
        </script>

    </body>

@endsection
