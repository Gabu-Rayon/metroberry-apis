<!doctype html>
<html lang="en">

<head>
    @csrf
    <meta name="base-url"content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible"content="IE=edge"/>
    <meta name="viewport"content="width=device-width, initial-scale=1.0"/>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>
        @yield('title')
    </title>
    <meta name="description"content="Login"/>
    <link rel="canonical"href="login.html"/>
    <meta name="robots"content="all"/>
    <meta property="og:description"content="Login"/>
    <meta property="og:title"content="Login"/>
    <meta property="og:url"content="login.html"/>
    <meta property="og:type"content="WebPage"/>
    <meta property="og:site_name"content="vms-laravel"/>

    <link rel="shortcut icon"href="{{asset('admin-assets/img/favicon.png?v=1')}}">    
    <link href="{{asset('admin-assets/vendor/bootstrap/css/bootstrap.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/vendor/metisMenu/metisMenu.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/vendor/datatables/dataTables.bootstrap4.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/vendor/typicons/src/typicons.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/vendor/themify-icons/themify-icons.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/vendor/material_icons/materia_icons.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/vendor/emojionearea/dist/emojionearea.min.css?v=1')}}"rel="stylesheet">
<link rel="stylesheet"href="../nanopkg-assets/vendor/highlight/highlight.min.css?v=1 {{asset('')}}">
<link href="{{asset('nanopkg-assets/vendor/sweetalert2/sweetalert2.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/vendor/fontawesome-free-6.3.0-web/css/all.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/vendor/bootstrap-icons/css/bootstrap-icons.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/vendor/toastr/build/toastr.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/css/arrow-hidden.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('nanopkg-assets/css/custom.min.css?v=1 ')}}"rel="stylesheet">

<!--Start Your Custom Style Now-->
<link href="{{asset('admin-assets/css/style-new.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/css/custom.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/css/extra.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/scss/customStyle.min.css?v=1')}}"rel="stylesheet">
<link href="{{asset('admin-assets/css/grapData.min.css?v=1')}}"rel="stylesheet">

        <link rel="stylesheet"href="{{asset('admin-assets/css/dashboard.min.css?v=1')}}">
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
    

        <!--Global script(used by all pages)-->
<script src="{{asset('admin-assets/vendor/jQuery/jquery.min.js?v=1')}}"></script>
<script src="{{asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js?v=1')}}"></script>
<script src="{{asset('admin-assets/vendor/emojionearea/dist/emojionearea.min.js?v=1')}}"></script>

        <script src="{{asset('module-assets/Language/js/localizer.min.js?v=1')}}"></script>
    
<script src="{{asset('admin-assets/vendor/metisMenu/metisMenu.min.js?v=1')}}"></script>
<script src="{{asset('admin-assets/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/sweetalert2/sweetalert2.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/fontawesome-free-6.3.0-web/js/all.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/toastr/build/toastr.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/axios/dist/axios.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/typed.js/lib/typed.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/vendor/jquery-validation-1.19.5/jquery.validate.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/js/axios.init.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/js/arrow-hidden.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/js/img-src.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/js/delete.min.js?v=1')}}"></script>
<script src="{{asset('nanopkg-assets/js/user-status-update.min.js?v=1 ')}}"></script>
<script src="{{asset('nanopkg-assets/js/main.js?v=1')}}"></script>

<!--Page Scripts(used by all page)-->
<script src="{{asset('admin-assets/js/sidebar.min.js?v=1')}}"></script>
        <script src="{{asset('admin-assets/vendor/amcharts5/index.min.js?v=1')}}"></script>
        <script src="{{asset('admin-assets/vendor/amcharts5/venn.js?v=1')}}"></script>

        <script src="{{asset('admin-assets/vendor/amcharts5/percent.min.js?v=1 ')}}"></script>
        <script src="{{asset('admin-assets/vendor/amcharts5/percent.min.js?v=1')}}"></script>
        <script src="{{asset('admin-assets/vendor/amcharts5/themes/Animated.min.js?v=1')}}"></script>
        <script src="{{asset('admin-assets/vendor/amcharts5/xy.min.js?v=1')}}"></script>
        <script src="{{asset('admin-assets/js/dashboard.min.js?v=1')}}"></script>
        <!-- end scripts -->
    <script src="{{asset('nanopkg-assets/js/tosterSession.min.js?v=1')}}"></script>

<script type="text/javascript">$(function(){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["department-table"]=$("#department-table").DataTable({"serverSide":true,"processing":true,"ajax":{"url":"https:\/\/vms.bdtask-demoserver.com\/admin\/department","type":"GET","data":function(data) {
            for (var i = 0, len = data.columns.length; i < len; i++) {
                if (!data.columns[i].search.value) delete data.columns[i].search;
                if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
            }
            delete data.search.regex;}},"columns":[{"data":"DT_RowIndex","name":"DT_RowIndex","title":"Sl","orderable":false,"searchable":false,"width":30,"className":"text-center"},{"data":"name","name":"name","title":"Name","orderable":true,"searchable":true,"defaultContent":"N\/A"},{"data":"created_at","name":"created_at","title":"Created","orderable":true,"searchable":true},{"data":"updated_at","name":"updated_at","title":"Updated","orderable":true,"searchable":true},{"data":"action","name":"action","title":"Action","orderable":false,"searchable":false,"width":80,"className":"text-center"}],"dom":"<'row mb-3'<'col-md-4'l><'col-md-4 text-center'B><'col-md-4'f>>rt<'bottom'<'row'<'col-md-6'i><'col-md-6'p>>><'clear'>","order":[],"responsive":true,"autoWidth":false,"headerCallback":function(thead, data, start, end, display) {
                    $(thead).addClass("table-success");
                },"lengthMenu":[[10,25,50,100,-1],[10,25,50,100,"All"]],"buttons":[{"extend":"reset","className":"btn btn-success box-shadow--4dp btn-sm-menu"},{"extend":"reload","className":"btn btn-success box-shadow--4dp btn-sm-menu"}]});});</script>
</body>

</html>
