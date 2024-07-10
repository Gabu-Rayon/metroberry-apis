<!doctype html>
<html lang="en">
<head>
    @csrf
    <meta name="base-url"content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible"content="IE=edge" />
    <meta name="viewport"content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        @yield('title')
    </title>
    <meta name="description"content="Login" />
    <link rel="canonical"href="login.html" />
    <meta name="robots"content="all" />
    <meta property="og:description"content="Login" />
    <meta property="og:title"content="Login" />
    <meta property="og:url"content="login.html" />
    <meta property="og:type"content="WebPage" />
    <meta property="og:site_name"content="vms-laravel" />

    <link rel="shortcut icon"href="{{ asset('admin-assets/img/sidebar-logo.png?v=1') }}">
    <link href="{{ asset('admin-assets/vendor/bootstrap/css/bootstrap.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/vendor/metisMenu/metisMenu.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/vendor/datatables/dataTables.bootstrap4.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/vendor/typicons/src/typicons.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/vendor/themify-icons/themify-icons.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/vendor/material_icons/materia_icons.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/vendor/emojionearea/dist/emojionearea.min.css?v=1') }}"rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('nanopkg-assets/vendor/yajra-laravel-datatables/assets/datatables.css?v=1') }}">
    <link rel="stylesheet"href="{{ asset('nanopkg-assets/vendor/highlight/highlight.min.css?v=1') }}">
    <link href="{{ asset('nanopkg-assets/vendor/sweetalert2/sweetalert2.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/vendor/fontawesome-free-6.3.0-web/css/all.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/vendor/bootstrap-icons/css/bootstrap-icons.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/vendor/toastr/build/toastr.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/css/arrow-hidden.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('nanopkg-assets/css/custom.min.css?v=1 ') }}"rel="stylesheet">

    <!--Start Your Custom Style Now-->
    <link href="{{ asset('admin-assets/css/style-new.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/css/custom.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/css/extra.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/scss/customStyle.min.css?v=1') }}"rel="stylesheet">
    <link href="{{ asset('admin-assets/css/grapData.min.css?v=1') }}"rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <link rel="stylesheet"href="{{ asset('admin-assets/css/dashboard.min.css?v=1') }}">
    <link href="{{asset('admin-assets/css/logout.css?v=1')}}" rel="stylesheet">
</head>

<body class="fixed sidebar-mini">
    <div class="main">
        @include('components.preloader')
        <div id="app">
            <div class="wrapper">
                @include('components.sidebar.sidebar')
                @include('components.navbar')
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('admin-assets/vendor/jQuery/jquery.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/emojionearea/dist/emojionearea.min.js?v=1') }}"></script>
    <script src="{{ asset('module-assets/Language/js/localizer.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/yajra-laravel-datatables/assets/datatables.js?v=1') }}"></script>
    <script src="{{ asset('module-assets/Language/js/localizer.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/metisMenu/metisMenu.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/sweetalert2/sweetalert2.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/fontawesome-free-6.3.0-web/js/all.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/toastr/build/toastr.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/axios/dist/axios.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/typed.js/lib/typed.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/vendor/jquery-validation-1.19.5/jquery.validate.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/axios.init.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/arrow-hidden.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/img-src.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/delete.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/user-status-update.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/main.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/js/sidebar.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/index.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/venn.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/percent.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/percent.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/themes/Animated.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/vendor/amcharts5/xy.min.js?v=1') }}"></script>
    <script src="{{ asset('admin-assets/js/dashboard.min.js?v=1') }}"></script>
    <script src="{{ asset('nanopkg-assets/js/tosterSession.min.js?v=1') }}"></script>

    <!-- Toastr Notification Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            @if(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif

            @if(Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @endif

            @if(Session::has('info'))
                toastr.info('{{ Session::get('info') }}');
            @endif

            @if(Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}');
            @endif
        });
    </script>

    <!-- DataTables Initialization -->
    <script type="text/javascript">
        $(function () {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["driver-table"] = $("#driver-table").DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "https:\/\/vms.bdtask-demoserver.com\/admin\/driver",
                    type: "GET",
                    data: function (data) {
                        for (var i = 0, len = data.columns.length; i < len; i++) {
                            if (!data.columns[i].search.value)
                                delete data.columns[i].search;
                            if (data.columns[i].searchable === true)
                                delete data.columns[i].searchable;
                            if (data.columns[i].orderable === true)
                                delete data.columns[i].orderable;
                            if (data.columns[i].data === data.columns[i].name)
                                delete data.columns[i].name;
                        }
                        delete data.search.regex;
                    }
                },
                columns: [
                    {
                        data: "id",
                        name: "id",
                        title: "id",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "id",
                        name: "id",
                        title: "id",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "email",
                        name: "email",
                        title: "email",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "phone",
                        name: "phone",
                        title: "phone",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "phone",
                        name: "phone",
                        title: "phone",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nid",
                        name: "nid",
                        title: "nid",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "address",
                        name: "address",
                        title: "address",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "address",
                        name: "address",
                        title: "address",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "license",
                        name: "license",
                        title: "license",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "image",
                        name: "image",
                        title: "image",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status",
                        name: "status",
                        title: "status",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        title: "created_at",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "updated_at",
                        name: "updated_at",
                        title: "updated_at",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "action",
                        name: "action",
                        title: "action",
                        orderable: false,
                        searchable: false
                    }
                ],
                "dom": "Bfrtip",
                "lengthMenu": [10, 25, 50, 100],
                "pageLength": 25,
                "language": {
                    "sEmptyTable": "No data available in table",
                    "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "sInfoEmpty": "Showing 0 to 0 of 0 entries",
                    "sInfoFiltered": "(filtered from _MAX_ total entries)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Show _MENU_ entries",
                    "sLoadingRecords": "Loading...",
                    "sProcessing": "Processing...",
                    "sSearch": "Search:",
                    "sZeroRecords": "No matching records found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>
</body>
</html>