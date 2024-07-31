@extends('layouts.app')

@section('title', 'Dashboard')

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
                                    <div class="d-flex justify-content-between align-items-center text-center gap-2">
                                        <h6 class="fs-17 fw-semi-bold mb-0">
                                            {{ Auth::user()->name }}
                                            <span class="badge bg-primary badge-sm text-sm ml-3">
                                                Billed {{ $station->payment_period }}
                                            </span>
                                        </h6>
                                        <div class="text-end">
                                            <a type="button" class="btn btn-success btn-sm" href="javascript:void(0);" onclick="axiosModal('{{ route('refueling.station.claim.payments') }}')">
                                                <i class="fa-solid fa-circle-check"></i>
                                                &nbsp;
                                                Claim Payments
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="fs-17 fw-semi-bold mb-0">Today's Transactions</h6>

                                    <div class="table-responsive mt-3">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Attendant Name</th>
                                                <th>Attendant Phone</th>
                                                <th>Date</th>
                                                <th>Volume</th>
                                                <th>Cost</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($total_cost = 0)
                                            @foreach ($refuellings as $refuelling)
                                                @php($total_cost += $refuelling->refuelling_cost)
                                                <tr>
                                                    <td>{{ $refuelling->attendant_name }}</td>
                                                    <td>{{ $refuelling->attendant_phone }}</td>
                                                    <td>{{ $refuelling->refuelling_date }}</td>
                                                    <td>{{ $refuelling->refuelling_volume }}</td>
                                                    <td>{{ $refuelling->refuelling_cost }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-end"><strong>Total</strong></td>
                                                <td><strong>KES {{ $total_cost }}</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="fs-17 fw-semi-bold mb-0">Past Unpaid Transactions</h6>

                                    <div class="table-responsive mt-3">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Attendant Name</th>
                                                <th>Attendant Phone</th>
                                                <th>Date</th>
                                                <th>Volume</th>
                                                <th>Cost</th>
                                                <th>Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($total_unpaid_cost = 0)
                                            @php($total_balance = 0)
                                            @foreach ($pastUnpaidRefuellings as $refuelling)
                                                @php ($total_unpaid_cost += $refuelling->refuelling_cost)
                                                @php ($totalPayments = $refuelling->fuelPayments->sum('amount'))
                                                @php ($balance = $refuelling->refuelling_cost - $totalPayments)
                                                @php ($total_balance += $balance)
                                            <tr>
                                                <td>{{ $refuelling->attendant_name }}</td>
                                                <td>{{ $refuelling->attendant_phone }}</td>
                                                <td>{{ $refuelling->refuelling_date }}</td>
                                                <td>{{ $refuelling->refuelling_volume }}</td>
                                                <td>{{ $refuelling->refuelling_cost }}</td>
                                                <td>{{ $balance }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                                            <td><strong>KES {{ $total_unpaid_cost }}</strong></td>
                                            <td><strong>KES {{ $total_balance }}</strong></td>
                                        </tr>
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
