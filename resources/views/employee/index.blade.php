@extends('layouts.app')

@section('title', 'Employees')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Employees</h6>
                                        </div>
                                        <div class="text-end">
                                            <div class="actions">
                                                <div class="accordion-header d-flex justify-content-end align-items-center" id="flush-headingOne">
                                                    @if(\Auth::user()->can('create customer'))
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('employee/create')">
                                                        <i class="fa fa-plus"></i>&nbsp; Add employee
                                                    </a>
                                                    @endif
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
                                                    <div id="flush-collapseOne"
                                                        class="accordion-collapse bg-white collapse"
                                                        aria-labelledby="flush-headingOne"
                                                        data-bs-parent="#accordionFlushExample" style="">
                                                        <div class='row pb-3 my-filter-form'>
                                                            <div class="col-sm-12 col-xl-4">
                                                                <div class="form-group row mb-1">
                                                                    <label for="name"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">Name</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            placeholder="Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-xl-4">
                                                                <div class="form-group row mb-1">
                                                                    <label for="organisation"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">
                                                                        Organisation
                                                                    </label>
                                                                    <div class="col-sm-7">
                                                                        <select class="form-control basic-single"
                                                                            name="organisation" id="organisation"
                                                                            tabindex="-1" aria-hidden="true">
                                                                            <option value="">Please select one</option>
                                                                            @foreach ($organisations as $org)
                                                                            <option value="{{ $org->id }}">
                                                                                {{ $org->user->name }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-xl-4">
                                                                <div class="form-group row mb-1">
                                                                    <label for="address"
                                                                        class="col-sm-5 col-form-label justify-content-start text-left">Address</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" class="form-control"
                                                                            id="address" name="address"
                                                                            placeholder="Address">
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
                                                    <th title="Name">Name</th>
                                                    <th title="Email">Email</th>
                                                    <th title="Phone">Phone</th>
                                                    <th title="Address">Address</th>
                                                    <th title="Organisation">Organisation</th>
                                                    <th title="Status">Status</th>
                                                    <th title="Action" width="80">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $customer)
                                                {{ \Log::info($customer) }}
                                                <tr>
                                                    <td>{{ $customer->user->name }}</td>
                                                    <td>{{ $customer->user->email }}</td>
                                                    <td>{{ $customer->user->phone }}</td>
                                                    <td>{{ $customer->user->address }}</td>
                                                    <td>{{ $customer->organisation->user->name }}</td>
                                                    <td>
                                                        @if ($customer->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                        @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('employee/{{ $customer->id }}/edit')">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <span class='m-1'></span>
                                                        @if ($customer->status == 'active')
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="axiosModal('employee/{{ $customer->id }}/deactivate')" title="Dectivate Driver">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </a> 
                                                        @else
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary" onclick="axiosModal('employee/{{ $customer->id }}/activate')" title="Activate Driver">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>                                                        
                                                        @endif
                                                        <span class='m-1'></span>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteCustomer({{ $customer->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <span class='m-1'></span>
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
                    <h5 class="modal-title">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>Are you sure you want to delete this employee? This action cannot be undone.</p>
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
        function deleteCustomer(customerId) {
            // Set the delete form action dynamically
            var form = document.getElementById('delete-modal-form');
            form.action = '/employee/' + customerId + '/delete';

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
