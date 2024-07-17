@extends('layouts.app')

@section('title', 'Service Types')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Service Types</h6>
                                        </div>
                                        <div class="text-end">
                                            <div class="actions">
                                                <div class="accordion-header d-flex justify-content-end align-items-center" id="flush-headingOne">
                                                    <a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('service/create')">
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Add Service Type
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
                                                    <th title="Email">Description</th>
                                                    <th title="Action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($serviceTypes as $serviceType)
                                                <tr>
                                                    <td>{{ $serviceType->name }}</td>
                                                    <td>{{ $serviceType->description }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="axiosModal('service/{{ $serviceType->id }}/edit')" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" onclick="axiosModal('service/{{ $serviceType->id }}/delete')" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
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
