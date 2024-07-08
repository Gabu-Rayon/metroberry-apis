@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

<body class="fixed sidebar-mini">

    @include('components.preloader')
    
    <div id="app">
        <div class="wrapper">

            @include('components.sidebar.sidebar')

            @include('components.navbar')
            
            <div class="body-content">

                @include('components.dashboard.card-stats')

    <div class="row mb-4">
                    <div class="col-xl-8 mb-4 mb-xl-0">
                <div class="card rounded-0">
                    <div class="card-header card_header px-3">
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <h6 class="fs-16 fw-bold mb-0">Last 12 month maintenance cost report</h6>
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-2">
                        <div id="line_chart" data-chat-data='[{"label":"Sep","value":58385,"color":"#000000"},{"label":"Oct","value":41822,"color":"#FF5733"},{"label":"Nov","value":2169655,"color":"#000000"},{"label":"Dec","value":40049,"color":"#FF5733"},{"label":"Jan","value":48858,"color":"#000000"},{"label":"Feb","value":35518,"color":"#FF5733"},{"label":"Mar","value":49522,"color":"#000000"},{"label":"Apr","value":37414,"color":"#FF5733"},{"label":"May","value":241839,"color":"#000000"},{"label":"Jun","value":11001,"color":"#FF5733"},{"label":"Jul","value":0,"color":"#000000"},{"label":"Jul","value":0,"color":"#FF5733"}]'
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
                        <div id="doughnut_chart" data-chat-data='[{"category":"Fuel","value":1554840.1399999997},{"category":"Maintenance","value":1494117.919999998},{"category":"Others","value":1622668.3900000013}]'
                            data-name='Expense report'></div>
                    </div>
                </div>
            </div>
            </div>
    <!-- 2nd  -->
            <div class="row mb-4">
            <div class="col-xl-4 mb-4 mb-xl-0">
                <div class="card rounded-0">
                    <div class="card-header card_header px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fs-16 fw-bold mb-0">Last 12 month vehicle requisition report</h6>
                            </h6>
                        </div>
                    </div>
                    <div class="card-body w-100 p-0 px-2">
                        <div id="venn_diagram" data-chat-data='{"pending":{"name":"Pending","value":2567,"color":"#dfd7d7"},"approved":{"name":"Approved","value":2570,"color":"#17c653"},"rejected":{"name":"Rejected","value":2547,"color":"#dc3545e0"}}'
                            data-name='Vehicle requisition report'></div>
                    </div>

                </div>
            </div>
            <div class="col-xl-8">
                <div class="card rounded-0">
                    <div class="card-header card_header px-3">
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <h6 class="fs-16 fw-bold mb-0">Last 12 month requisition report</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="multi_axis_line" data-chat-data='[{"date":1690848000000,"pending":275,"approved":286},{"date":1693526400000,"pending":257,"approved":278},{"date":1696118400000,"pending":279,"approved":300},{"date":1698796800000,"pending":294,"approved":252},{"date":1701388800000,"pending":311,"approved":279},{"date":1704067200000,"pending":272,"approved":269},{"date":1706745600000,"pending":276,"approved":284},{"date":1709251200000,"pending":276,"approved":287},{"date":1711929600000,"pending":259,"approved":268},{"date":1714521600000,"pending":66,"approved":64},{"date":1717200000000,"pending":2,"approved":3},{"date":1719792000000,"pending":0,"approved":0}]'
                            data-name='Vehicle requisition report'></div>
                    </div>
                </div>
            </div>
        </div>
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
                    <table class="table table-striped table-borderless table-hover rounded-3 table-light">
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
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Cadillac-95769</td>
                                    <td class="py-3">Vehicle Ownership Transfer</td>
                                    <td class="py-3">1976-07-12</td>
                                    <td class="py-3">1976-07-12</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Suzuki-80937</td>
                                    <td class="py-3"></td>
                                    <td class="py-3">2011-01-13</td>
                                    <td class="py-3">2011-01-13</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Suzuki-80937</td>
                                    <td class="py-3">Vehicle Ownership Transfer</td>
                                    <td class="py-3">1975-12-05</td>
                                    <td class="py-3">1975-12-05</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Lexus-49180</td>
                                    <td class="py-3">Vehicle Insurance</td>
                                    <td class="py-3">2007-09-07</td>
                                    <td class="py-3">2007-09-07</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Mazda-88814</td>
                                    <td class="py-3"></td>
                                    <td class="py-3">1993-05-11</td>
                                    <td class="py-3">1993-05-11</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Infiniti-46968</td>
                                    <td class="py-3">Vehicle Road Worthiness</td>
                                    <td class="py-3">2013-12-11</td>
                                    <td class="py-3">2013-12-11</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Infiniti-46968</td>
                                    <td class="py-3">Vehicle Insurance</td>
                                    <td class="py-3">2022-03-08</td>
                                    <td class="py-3">2022-03-08</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Lexus-49180</td>
                                    <td class="py-3">Vehicle Fitness</td>
                                    <td class="py-3">1972-09-07</td>
                                    <td class="py-3">1972-09-07</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Mazda-88814</td>
                                    <td class="py-3">Vehicle Route Permit</td>
                                    <td class="py-3">1995-11-18</td>
                                    <td class="py-3">1995-11-18</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Buick-14376</td>
                                    <td class="py-3">Vehicle Fitness</td>
                                    <td class="py-3">1987-09-18</td>
                                    <td class="py-3">1987-09-18</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Buick-14376</td>
                                    <td class="py-3">Vehicle Fitness</td>
                                    <td class="py-3">1977-06-24</td>
                                    <td class="py-3">1977-06-24</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Cadillac-32003</td>
                                    <td class="py-3">Vehicle Ownership Transfer</td>
                                    <td class="py-3">2018-10-20</td>
                                    <td class="py-3">2018-10-20</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Cadillac-95769</td>
                                    <td class="py-3">Vehicle Route Permit</td>
                                    <td class="py-3">1995-07-31</td>
                                    <td class="py-3">1995-07-31</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
                                </tr>

                                                            <tr>
                                    <td class="py-3">Infiniti-46968</td>
                                    <td class="py-3"></td>
                                    <td class="py-3">1978-03-01</td>
                                    <td class="py-3">1978-03-01</td>
                                    <td class="py-3 text-center"><span class="badge bg-danger py-2 px-4 rounded-pill">Expired</span></td>
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
                        <a class="page-link" href="admin/dashboard?page=2" rel="next">Next &raquo;</a>
                    </li>
                            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
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
                    
                                            <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    
                    
                                            
                        
                        
                                                                                                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=2">2</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=3">3</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=4">4</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=5">5</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=6">6</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=7">7</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=8">8</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=9">9</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=10">10</a></li>
                                                                                                                                
                                                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                        
                        
                                                                    
                        
                        
                                                                                                                        <li class="page-item"><a class="page-link" href="admin/dashboard?page=67">67</a></li>
                                                                                                                                <li class="page-item"><a class="page-link" href="admin/dashboard?page=68">68</a></li>
                                                                                                        
                    
                                            <li class="page-item">
                            <a class="page-link" href="admin/dashboard?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
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
                <footer class="footer-content border-top">
    <div class="footer-text">
        <div class="row">
            <div class="col-md-6">
                <div class="copy">
                    © 2024 <a class="text-capitalize text-black" href=""
                        target="_blank">Vms laravel</a>.
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="credit">Designed and developed by: <a class="text-black text-capitalize"
                        href="https://www.bdtask.com/" target="_blank">Bdtask<a>
                </div>
            </div>
        </div>
    </div>
</footer>
            </div>
        </div>
        <!--end  vue page -->
    </div>
    <!-- END layout-wrapper -->

        <!-- Modal -->
<div class="modal fade" id="delete-modal"
    data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="true"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" class="needs-validation" id="delete-modal-form">
            <div class="modal-body">
                <p>Are you sure you want to delete this item? you won t be able to revert this item back!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="submit" id="delete_submit">Delete</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>

</body>

@endsection