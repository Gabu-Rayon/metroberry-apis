@extends('layouts.app')

@section('title', 'Dashboard')
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
                        @include('components.dashboard.organisations-card-stats')

                        <div class="row mb-4">
                            <div class="col-xl-8 mb-4 mb-xl-0">
                                <div class="card rounded-0">
                                    <div class="card-header card_header px-3">
                                        <div class="d-lg-flex justify-content-between align-items-center">
                                            <h6 class="fs-16 fw-bold mb-0">Last 12 month Expenses  report</h6>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="card-body px-2">
                                        <div id="line_chart"
                                            data-chat-data='[{"label":"Sep","value":58385,"color":"#000000"},{"label":"Oct","value":41822,"color":"#FF5733"},{"label":"Nov","value":2169655,"color":"#000000"},{"label":"Dec","value":40049,"color":"#FF5733"},{"label":"Jan","value":48858,"color":"#000000"},{"label":"Feb","value":35518,"color":"#FF5733"},{"label":"Mar","value":49522,"color":"#000000"},{"label":"Apr","value":37414,"color":"#FF5733"},{"label":"May","value":241839,"color":"#000000"},{"label":"Jun","value":11001,"color":"#FF5733"},{"label":"Jul","value":0,"color":"#000000"},{"label":"Jul","value":0,"color":"#FF5733"}]'
                                            data-name='Maintenance cost'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card rounded-0">
                                    <div class="card-header card_header px-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fs-16 fw-bold mb-0">Last 12 month expense report</h6>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 px-2">
                                        <div id="doughnut_chart"
                                            data-chat-data='[{"category":"Fuel","value":1554840.1399999997},{"category":"Maintenance","value":1494117.919999998},{"category":"Others","value":1622668.3900000013}]'
                                            data-name='Expense report'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 2nd  -->
                        <!-- new chart.js End -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fs-17 font-weight-600 mb-0">Reminder</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-borderless table-hover rounded-3 table-light">
                                        <thead>
                                            <tr>
                                                <th class="py-3">Vehicle no</th>
                                                <th class="py-3">Document name</th>
                                                <th class="py-3">Expiration date</th>
                                                <th class="py-3">Renewal date</th>
                                                <th class="py-3 text-center">Current status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3">Cadillac-32003</td>
                                                <td class="py-3"></td>
                                                <td class="py-3">1976-03-26</td>
                                                <td class="py-3">1976-03-26</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Cadillac-95769</td>
                                                <td class="py-3">Vehicle Ownership Transfer</td>
                                                <td class="py-3">1976-07-12</td>
                                                <td class="py-3">1976-07-12</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Suzuki-80937</td>
                                                <td class="py-3"></td>
                                                <td class="py-3">2011-01-13</td>
                                                <td class="py-3">2011-01-13</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Suzuki-80937</td>
                                                <td class="py-3">Vehicle Ownership Transfer</td>
                                                <td class="py-3">1975-12-05</td>
                                                <td class="py-3">1975-12-05</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Lexus-49180</td>
                                                <td class="py-3">Vehicle Insurance</td>
                                                <td class="py-3">2007-09-07</td>
                                                <td class="py-3">2007-09-07</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Mazda-88814</td>
                                                <td class="py-3"></td>
                                                <td class="py-3">1993-05-11</td>
                                                <td class="py-3">1993-05-11</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Infiniti-46968</td>
                                                <td class="py-3">Vehicle Road Worthiness</td>
                                                <td class="py-3">2013-12-11</td>
                                                <td class="py-3">2013-12-11</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Infiniti-46968</td>
                                                <td class="py-3">Vehicle Insurance</td>
                                                <td class="py-3">2022-03-08</td>
                                                <td class="py-3">2022-03-08</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Lexus-49180</td>
                                                <td class="py-3">Vehicle Fitness</td>
                                                <td class="py-3">1972-09-07</td>
                                                <td class="py-3">1972-09-07</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Mazda-88814</td>
                                                <td class="py-3">Vehicle Route Permit</td>
                                                <td class="py-3">1995-11-18</td>
                                                <td class="py-3">1995-11-18</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Buick-14376</td>
                                                <td class="py-3">Vehicle Fitness</td>
                                                <td class="py-3">1987-09-18</td>
                                                <td class="py-3">1987-09-18</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Buick-14376</td>
                                                <td class="py-3">Vehicle Fitness</td>
                                                <td class="py-3">1977-06-24</td>
                                                <td class="py-3">1977-06-24</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Cadillac-32003</td>
                                                <td class="py-3">Vehicle Ownership Transfer</td>
                                                <td class="py-3">2018-10-20</td>
                                                <td class="py-3">2018-10-20</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Cadillac-95769</td>
                                                <td class="py-3">Vehicle Route Permit</td>
                                                <td class="py-3">1995-07-31</td>
                                                <td class="py-3">1995-07-31</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="py-3">Infiniti-46968</td>
                                                <td class="py-3"></td>
                                                <td class="py-3">1978-03-01</td>
                                                <td class="py-3">1978-03-01</td>
                                                <td class="py-3 text-center"><span
                                                        class="badge bg-danger py-2 px-4 rounded-pill">Expired</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <nav class="d-flex justify-items-center justify-content-between">
                                    <div class="d-flex justify-content-between flex-fill d-sm-none">
                                        <ul class="pagination">

                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link">&laquo; Previous</span>
                                            </li>


                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="https://vms.bdtask-demoserver.com/admin/dashboard?page=2"
                                                    rel="next">Next &raquo;</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div
                                        class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                                        <div>
                                            <p class="small text-muted">
                                                Showing
                                                <span class="fw-semibold">1</span>
                                                To
                                                <span class="fw-semibold">15</span>
                                                of
                                                <span class="fw-semibold">1006</span>
                                                results
                                            </p>
                                        </div>

                                        <div>
                                            <ul class="pagination">

                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="&laquo; Previous">
                                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                </li>





                                                <li class="page-item active" aria-current="page"><span
                                                        class="page-link">1</span></li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=2">2</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=3">3</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=4">4</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=5">5</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=6">6</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=7">7</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=8">8</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=9">9</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=10">10</a>
                                                </li>

                                                <li class="page-item disabled" aria-disabled="true"><span
                                                        class="page-link">...</span></li>





                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=67">67</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=68">68</a>
                                                </li>


                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="https://vms.bdtask-demoserver.com/admin/dashboard?page=2"
                                                        rel="next" aria-label="Next &raquo;">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

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
