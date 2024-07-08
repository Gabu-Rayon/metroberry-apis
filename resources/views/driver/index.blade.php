@extends('layouts.app')

@section('title', 'Drivers')
@section('content')

<div class="body-content">
    <div class="tile">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 fw-semi-bold mb-0">Driver list</h6>
                    </div>
                    <div class="text-end">
                        <div class="actions">
                            <a class="btn btn-success" href="javascript:void(0);" onclick="axiosModal('admin/driver/create')">
                                <i class="fa fa-plus"></i>&nbsp;
                                Add driver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive">
                        <table class="table" id="driver-table">
                            <thead>
                                <tr>
                                    <th title="Name">Name</th>
                                    <th title="Type">Email</th>
                                    <th title="Type">Phone</th>
                                    <th title="Nid">Address</th>
                                    <th title="Action" width="80">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($drivers as $driver)
                                <tr>
                                    <td>{{$driver->user->name}}</td>
                                    <td>{{$driver->user->email}}</td>
                                    <td>{{$driver->user->phone}}</td>
                                    <td>{{$driver->user->address}}</td>
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

@endsection