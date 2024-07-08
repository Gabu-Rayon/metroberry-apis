@extends('layouts.app')

@section('title', 'Metro Berry')
@section('content')

<body class="fixed sidebar-mini">

    @include('components.preloader')
    <!-- react page -->
    <div class="container-fluid ">
        <div class="d-flex align-items-center justify-content-center text-center h-100vh">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="four_zero_four_bg">
                        <h1 class="fw-bold text-monospace">404</h1>
                    </div>
                    <div class="contant_box_505">
                        <h3 class="h2">Forbidden!</h3>
                        <p><b>403 - Forbidden:</b> You don t have permission to access on the server </p>
                    </div>
                    <div>
                        <a class="btn btn-success mt-3" href="admin/refueling/station">
                        <i class="typcn typcn-arrow-back-outline mr-1"></i>
                        Back
                    </a>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <footer class="text-center text-black">
                        <div class="">
                            <div class="copy">© 2024 <a class="text-capitalize" href="" target="_blank">vms-laravel</a>.</div>
                            <div class="credit">Designed &amp;amp; developed by: <a href="https://www.bdtask.com/" target="_blank">Bdtask<a></div>
    </div>
</footer>

            </div>
        </div>
    </div>
    </div>
    <!-- /.End of form wrapper -->
@endsection