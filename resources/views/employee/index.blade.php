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
                                                     <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('employee/export')" title="Export to xlsx excel file">
                                                        <i class="fa-solid fa-file-export"></i>&nbsp; Export
                                                    </a>
                                                     <span class='m-1'></span>
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('employee/import')" title="Import From csv excel file">
                                                        <i class="fa-solid fa-file-arrow-up"></i>&nbsp; Import
                                                    </a>
                                                     <span class='m-1'></span>
                                                    @if(\Auth::user()->can('create customer'))
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('employee/create')" title="Add new Employee Details.">
                                                        <i class="fa fa-plus"></i>&nbsp; Add employee
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
                                                    <td class="text-center">
                                                        @if (\Auth::user()->can('edit customer'))
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="axiosModal('employee/{{ $customer->id }}/edit')">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endif
                                                        <span class='m-1'></span>
                                                        @if (\Auth::user()->can('activate customer'))
                                                            @if ($customer->status == 'active')
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="axiosModal('employee/{{ $customer->id }}/deactivate')" title="Dectivate Employee">
                                                                    <i class="fas fa-toggle-on"></i>
                                                                </a> 
                                                            @else
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-secondary" onclick="axiosModal('employee/{{ $customer->id }}/activate')" title="Activate Employee">
                                                                    <i class="fas fa-toggle-off"></i>
                                                                </a>                                                        
                                                            @endif
                                                        @endif
                                                        <span class='m-1'></span>
                                                         @if (\Auth::user()->can('delete customer'))
                                                         <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="axiosModal('employee/{{ $customer->id }}/delete')" title="Delete Customer">
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
