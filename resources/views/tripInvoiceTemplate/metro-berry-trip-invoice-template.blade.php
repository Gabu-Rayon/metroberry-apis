@extends('layouts.app')

@section('title', 'Vehicle List')
@section('content')
    <style>
        /* Custom styles */
        .left-section {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .right-section {
            background-color: #fff;
            padding: 20px;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .details {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .table-section {
            background-color: #f7f7f7;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .table {
            margin-bottom: 0;
        }
    </style>

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

                        <div class="text-center">
                            <h5></h5>
                            <div class="container  border border-dark border-3">
                                <div class="row">
                                    <div class="col-md-4 left-section">
                                        <img class="logo" alt="Metroberry Logo"
                                            src="{{ asset('admin-assets/img/sidebar-logo.png?v=1') }}" />
                                        <div class="mb-4">
                                            <p>If you have any questions concerning this invoice, use the following contact
                                                information:</p>
                                            <p>Contact Thomas, Phone Number: +254748 156 366.</p>
                                            <p>Email: metroberry254@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8 right-section">
                                        <h5 class="mb-3 text-uppercase text-dark">
                                            <!-- For INVOICE, each letter should have a span for styling -->
                                            <span>I</span><span>N</span><span>V</span><span>O</span><span>I</span><span>C</span><span>E</span>
                                        </h5>
                                        <div class="details">
                                            <p>Invoice #1</p>
                                            <p>Date: 2024-03-03</p>
                                            <p>victor</p>
                                            <p>Westlands Кепуа</p>
                                        </div>
                                        <div class="table-section">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Units</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>...</td>
                                                        <td>...</td>
                                                        <td>200.00</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2"></th>
                                                        <td class="bg-danger"> Total: 200.00</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-info">
                                            <p>Payment Info:</p>
                                            <p>Please make all checks payable to Metroberry Tours and Travel</p>
                                            <p>Bank transfers payable to: Metroberry Tours and Travel</p>
                                            <p>Bank Name: Stanbic Bank of Kenya</p>
                                            <p>Account Number: 0100007750767</p>
                                            <p>Branch: Chiromo Branch</p>
                                            <p>Swift Code: SBICKENK</p>
                                            <p>Branch code: 007</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            @endsection
