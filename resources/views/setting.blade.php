@extends('layouts.app')

@section('title', 'Setting List')
@section('content')

<body class="fixed sidebar-mini">

    @include('components.preloader')
    <!-- react page -->
    <!-- react page -->
    <div id="app">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- start header -->
            <nav class="sidebar sidebar-bunker sidebar-sticky overflow-hidden">
    <div class="sidebar-header">
        <a href="https://vms.bdtask-demoserver.com" class="sidebar-brand">
            <img class="sidebar-logo-lg"
                src="../admin-assets/img/sidebar-logo.png?v=1">
            <img class="sidebar-logo-sm" src="../admin-assets/img/favicon.png?v=1">
        </a>
    </div>

  
            <!-- end header -->
            <div class="content-wrapper">
                <div class="main-content">
                    <nav class="navbar-custom-menu navbar navbar-expand-lg m-0 border-bottom shadow-none">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div>
    <!--/.sidebar toggle icon-->
    <div class="navbar-icon d-flex">
        <ul class="navbar-nav flex-row align-items-center ">
            <li class="nav-item dropdown language-menu notification  me-3">
                <a class="language-menu_item border rounded-circle d-flex justify-content-center align-items-center overflow-hidden"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src=" storage/language/flag/2qUSHXENGj7TKN86U1SChajzSsmqlPupBn9hOULH.svg?v=1">
                </a>
                <div class="dropdown-menu language_dropdown">
                                            <a href="lang/en"
                            class="language_item d-flex align-items-center gap-3">
                            <img src="storage/language/flag/2qUSHXENGj7TKN86U1SChajzSsmqlPupBn9hOULH.svg?v=1">
                            <span>
                                English
                            </span>
                        </a>
                                            <a href="lang/bn"
                            class="language_item d-flex align-items-center gap-3">
                            <img src="storage/language/flag/NnhGPAjhaSbw08YybMOMvkZvb2jTRzeJpJDXJ7cA.svg?v=1">
                            <span>
                                বাংলা
                            </span>
                        </a>
                                            <a href="lang/ar"
                            class="language_item d-flex align-items-center gap-3">
                            <img src="storage/language/flag/jzq7Njrm2LjCU0gtBnrh40xsM42ygZtifAcLMCqK.png?v=1">
                            <span>
                                Arabic
                            </span>
                        </a>
                                    </div>
                <!--/.dropdown-menu -->
            </li>
            <!--/.dropdown-->
            <li class="nav-item dropdown user_profile me-2">
                <a class="dropdown-toggle user_profile_item border rounded-circle  d-flex justify-content-center align-items-center overflow-hidden"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class='img-fluid' src="https://ui-avatars.com/api/?name=A&amp;color=7F9CF5&amp;background=EBF4FF" alt="">
                </a>
                <div class="dropdown-menu">
                    <div class="d-flex align-items-center gap-3 border-bottom pb-3">
                        <div class="user_img">
                            <img src="https://ui-avatars.com/api/?name=A&amp;color=7F9CF5&amp;background=EBF4FF" alt="">
                        </div>
                        <div>
                            <p class="mb-0 fw-bold fs-16">
                                Admin
                            </p>
                            <p class="mb-0 text-muted fs-14">
                                admin@gmail.com
                            </p>
                        </div>
                    </div>

                    <ul class="list-unstyled mt-3  dropdown_menu_inner">
                        <li class="">
                            <a class="d-block"
                                href="user/profile">My profile</a>
                        </li>
                        <li class="">
                            <a class="d-block"
                                href="user/profile-setting/edit">Edit profile</a>
                        </li>
                        <li class="">
                            <a class="d-block"
                                href="user/profile-setting">Account settings</a>
                        </li>
                        <form method="POST" action="logout" class="d-inline">
    <input type="hidden" name="_token" value="AQNLvAb467g0eZtkGATqrKcNNVohCNfvLiX4IjQc" autocomplete="off">    <button type="submit" id="logout-btn"class="btn_sign_out text-black w-auto">
        Sign out
    </button>
</form>
<link href="../admin-assets/css/logout.css?v=1" rel="stylesheet">

                    </ul>


                </div>
                <!--/.dropdown-menu -->
            </li>
        </ul>
        <!--/.navbar nav-->

    </div>
</nav>

                    <div class="body-content">
                        <!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="row">
        <div class="col-md-12 my-2">
            <nav class="sidebar-nav card py-2 sub-side-bar p-2 py-3">
    <ul class=" nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false">
                <i class="typcn typcn-adjust-brightness"></i>
                General settings
            </a>
            <ul class="dropdown-menu">
                                                        <li class="mm-active">
                        <a href="admin/setting?g=Site"
                            class="dropdown-item settings-goroup">Site</a>
                    </li>
                                                        <li class="">
                        <a href="admin/setting?g=Vendor"
                            class="dropdown-item settings-goroup">Vendor</a>
                    </li>
                                                        <li class="">
                        <a href="admin/setting?g=Fuel"
                            class="dropdown-item settings-goroup">Fuel</a>
                    </li>
                                                        <li class="">
                        <a href="admin/setting?g=Maintenance"
                            class="dropdown-item settings-goroup">Maintenance</a>
                    </li>
                                                        <li class="">
                        <a href="admin/setting?g=Inventory"
                            class="dropdown-item settings-goroup">Inventory</a>
                    </li>
                                                        <li class="">
                        <a href="admin/setting?g=Purchase"
                            class="dropdown-item settings-goroup">Purchase</a>
                    </li>
                            </ul>
        </li>
                    <li class="nav-item  ">
                <a href="admin/setting/mail">
                    <i class="typcn typcn-mail"></i>
                    Mail setting
                </a>
            </li>
                                            <li class="nav-item  ">
                <a href="admin/setting/env">
                    <i class="typcn typcn-document-text"></i>
                    Env setting
                </a>
            </li>
                            <li class="nav-item  ">
                <a href="admin/language">
                    <i class="typcn typcn-sort-alphabetically"></i>
                    Language
                </a>
            </li>
                                    <li class="nav-item  ">
                <a href="javascript:void(0);" onclick="storageLink('dev/artisan-http/storage-link')">
                    <i class="typcn typcn-arrow-loop-outline"></i>
                    Fix storage link
                </a>
            </li>
            </ul>
</nav>
        </div>
        <div class="col-md-12">
                        <div class="card mb-4 p-5">
                <form action="admin/setting" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="AQNLvAb467g0eZtkGATqrKcNNVohCNfvLiX4IjQc" autocomplete="off">    <input type="hidden" name="_method" value="PUT">    <input type="hidden" name="setting_tab" class="setting_tab" value="Site" />

    <div>
                    <fieldset>
                <legend>Site Url</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.url')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.url')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/3/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/3/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                <input id="site.url" class="form-control" type="text"
                                        placeholder="Setting Site Url" name="data[3]"
                                        id="data[3]" value="https://www.bdtask.com"
                                                                                 />
                                                            <div class="my-1">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
                        <fieldset>
                <legend>Name</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.name')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.name')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/1/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/1/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                <input id="site.name" class="form-control" type="text"
                                        placeholder="Setting Name" name="data[1]"
                                        id="data[1]" value="Bdtask"
                                                                                 />
                                                            <div class="my-1">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
                        <fieldset>
                <legend>Description</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.description')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.description')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/2/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/2/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                <textarea class="form-control" name="data[2]" id="data[2]"
                                        placeholder="Setting Description"
                                                                                >Want to study abroad ? Get free expert advice and information on colleges, courses, exams, admission, student visa, and application process to study overseas.</textarea>
                                                            <div class="my-1">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
                        <fieldset>
                <legend>Logo White</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.logo_light')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.logo_light')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/4/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/4/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                                                        <div class="mt-1 mb-2">
                                            <a href="storage/setting/wMMoqiSiD6aqkO4CeiA4LzylK4Gbq4QAoP5OttpM.png" target="_blank">
                                                <img src="storage/setting/wMMoqiSiD6aqkO4CeiA4LzylK4Gbq4QAoP5OttpM.png" class="setting_key_image">
                                            </a>
                                            <a href="admin/setting/4/unset-value">
                                                <img src="../nanopkg-assets/image/setting/close.svg?v=1">
                                            </a>
                                        </div>
                                                                        <input id="site.logo_light" class="form-control" type="file"
                                        placeholder="Logo White" name="data[4]"
                                                                            accept="image/*"  />
                                                            <div class="my-1">
                                Default image size 205x60
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
                        <fieldset>
                <legend>Logo Black</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.logo_black')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.logo_black')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/5/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/5/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                                                    <input id="site.logo_black" class="form-control" type="file"
                                        placeholder="Logo Black" name="data[5]"
                                                                            accept="image/*"  />
                                                            <div class="my-1">
                                Default image size 205x60
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
                        <fieldset>
                <legend>Favicon</legend>
                <div class="d-flex justify-content-between">
                    <div class="panel-heading my-2">
                        <code
                            class="badge badge-pill badge-info text-light setting_key">setting('site.favicon')</code>
                        <a href="javascript:void(0);" class="panel-action-btn clipboard"
                            data-clipboard-text="setting('site.favicon')">
                            <svg width="18px" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000"
                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M761.3,924.7H108v-588h653.3v196h65.3V206c0-35.7-29.6-65.3-65.3-65.3h-196C565.3,68.2,507.1,10,434.7,10C362.2,10,304,68.2,304,140.7H108c-35.7,0-65.3,29.6-65.3,65.3v718.7c0,35.7,29.6,65.3,65.3,65.3h653.3c35.7,0,65.3-29.6,65.3-65.3V794h-65.3V924.7z M238.7,206c29.6,0,29.6,0,65.3,0s65.3-29.6,65.3-65.3c0-35.7,29.6-65.3,65.3-65.3c35.7,0,65.3,29.6,65.3,65.3c0,35.7,32.7,65.3,65.3,65.3c32.7,0,33.7,0,65.3,0s65.3,29.6,65.3,65.3H173.3C173.3,231.5,201.9,206,238.7,206z M173.3,728.7H304v-65.3H173.3V728.7z M630.7,598V467.3l-261.3,196l261.3,196V728.7h326.7V598H630.7z M173.3,859.3h196V794h-196V859.3z M500,402H173.3v65.3H500V402z M304,532.7H173.3V598H304V532.7z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="panel-actions">
                        <a href="admin/setting/6/move-down"
                            class="panel-action-btn" title="Move Down">
                            <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                        </a>
                        <a href="admin/setting/6/move-up"
                            class="panel-action-btn" title="Move Up">
                            <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                        </a>
                    </div>
                </div>
                <div class="panel-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                                                                                                    <input id="site.favicon" class="form-control" type="file"
                                        placeholder="Favicon" name="data[6]"
                                                                            accept="image/*"  />
                                                            <div class="my-1">
                                Default image size 68x68
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            
        </div>
                    <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Save settings</button>
            </div>
                
    </form>
    <span id="media-upload-url" data-file-upload-url="admin/setting/file-upload"></span>
            </div>
        </div>
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
@endsection
