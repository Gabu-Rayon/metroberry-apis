@extends('layouts.app')

@section('title', 'Vehicle Parts')
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
                                            <h6 class="fs-17 fw-semi-bold mb-0">Vehicle Parts</h6>
                                        </div>
                                        <div class="text-end">
                                            <div class="actions">
                                                <div class="accordion-header d-flex justify-content-end align-items-center" id="flush-headingOne">
                                                    <a
                                                        class="btn btn-success btn-sm"
                                                        href="javascript:void(0);"
                                                        onclick="axiosModal('{{ route('vehicle.maintenance.parts.create') }}')"
                                                    >
                                                        <i class="fa fa-plus"></i>
                                                        &nbsp;
                                                        Add Vehicle Part
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
                                                    <th title="Category">Category</th>
                                                    <th title="Brand">Brand</th>
                                                    <th title="Quantity">Quantity</th>
                                                    <th title="Price">Price</th>
                                                    <th title="Action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parts as $part)
                                                <tr>
                                                    <td>{{ $part->name }}</td>
                                                    <td>{{ $part->category->name }}</td>
                                                    <td>{{ $part->brand }}</td>
                                                    <td>{{ $part->quantity }}</td>
                                                    <td>KES {{ $part->price }}</td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" onclick="axiosModal('{{ route('vehicle.maintenance.parts.edit', $part->id) }}')" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" onclick="axiosModal('{{ route('vehicle.maintenance.parts.delete', $part->id) }}')" class="btn btn-danger btn-sm">
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
