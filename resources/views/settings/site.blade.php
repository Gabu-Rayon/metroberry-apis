@extends('layouts.app')

@section('title', 'Setting List')
@section('content')

    <body class="fixed sidebar-mini">

        @include('components.preloader')
        <div id="app">
           @include('components.sidebar.sidebar')
                <div class="content-wrapper">
                    <div class="main-content">
                        @include('components.navbar')
                                <div class="body-content">

                                    <div class="row">

                                        <div class="col-md-12 my-2">
                                            @include('components.settings-nav')
                                        </div>

                                        <div class="col-md-12">

                                            <div class="card mb-4 p-5">
                                                
                                                <form action="{{ route('settings') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">

                                                    <div>

                                                        <fieldset>
                                                            <legend>Site Url</legend>
                                                            <div class="d-flex justify-content-between">
                                                                <div class="panel-heading my-2">
                                                                    <code class="badge badge-pill badge-info text-light setting_key">{{ url('/') }}</code>
                                                                    <a href="javascript:void(0);" class="panel-action-btn clipboard" data-clipboard-text="{{ url('/') }}">
                                                                        <i class="fas fa-clipboard"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="panel-actions">
                                                                    <a href="admin/setting/3/move-down" class="panel-action-btn" title="Move Down">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">
                                                                    </a>
                                                                    <a href="admin/setting/3/move-up" class="panel-action-btn" title="Move Up">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input id="site_url" class="form-control" type="text" placeholder="Site Url" name="site_url" id="site_url" value="{{ url('/') }}" />
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
                                                                        class="badge badge-pill badge-info text-light setting_key">{{ config('app.name') }}</code>
                                                                    <a href="javascript:void(0);" class="panel-action-btn clipboard" data-clipboard-text="{{ config('app.name') }}">
                                                                        <i class="fas fa-clipboard"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="panel-actions">
                                                                    <a href="admin/setting/1/move-down" class="panel-action-btn" title="Move Down">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">
                                                                    </a>
                                                                    <a href="admin/setting/1/move-up" class="panel-action-btn" title="Move Up">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input id="site_name" class="form-control" type="text" placeholder="Setting Name" name="site_name" id="site_name" value="{{ config('app.name') }}" />
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
                                                                    <code class="badge badge-pill badge-info text-light setting_key">{{ config('app.description') }}</code>
                                                                    <a href="javascript:void(0);" class="panel-action-btn clipboard" data-clipboard-text="{{ config('app.description') }}">
                                                                        <i class="fas fa-clipboard"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="panel-actions">
                                                                    <a href="admin/setting/2/move-down" class="panel-action-btn" title="Move Down">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">
                                                                    </a>
                                                                    <a href="admin/setting/2/move-up" class="panel-action-btn" title="Move Up">
                                                                        <img src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" name="app_description" id="app_description" placeholder="Description">{{ config('app.description') }}</textarea>
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
                                                                    <a href="javascript:void(0);"
                                                                        class="panel-action-btn clipboard"
                                                                        data-clipboard-text="setting('site.logo_light')">
                                                                        <svg width="18px" version="1.1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            x="0px" y="0px" viewBox="0 0 1000 1000"
                                                                            enable-background="new 0 0 1000 1000"
                                                                            xml:space="preserve">
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
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                                                                    </a>
                                                                    <a href="admin/setting/4/move-up"
                                                                        class="panel-action-btn" title="Move Up">
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mt-1 mb-2">
                                                                            <a href="storage/setting/wMMoqiSiD6aqkO4CeiA4LzylK4Gbq4QAoP5OttpM.png"
                                                                                target="_blank">
                                                                                <img src="storage/setting/wMMoqiSiD6aqkO4CeiA4LzylK4Gbq4QAoP5OttpM.png"
                                                                                    class="setting_key_image">
                                                                            </a>
                                                                            <a href="admin/setting/4/unset-value">
                                                                                <img
                                                                                    src="../nanopkg-assets/image/setting/close.svg?v=1">
                                                                            </a>
                                                                        </div>
                                                                        <input id="site.logo_light" class="form-control"
                                                                            type="file" placeholder="Logo White"
                                                                            name="data[4]" accept="image/*" />
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
                                                                    <a href="javascript:void(0);"
                                                                        class="panel-action-btn clipboard"
                                                                        data-clipboard-text="setting('site.logo_black')">
                                                                        <svg width="18px" version="1.1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            x="0px" y="0px" viewBox="0 0 1000 1000"
                                                                            enable-background="new 0 0 1000 1000"
                                                                            xml:space="preserve">
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
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                                                                    </a>
                                                                    <a href="admin/setting/5/move-up"
                                                                        class="panel-action-btn" title="Move Up">
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input id="site.logo_black" class="form-control"
                                                                            type="file" placeholder="Logo Black"
                                                                            name="data[5]" accept="image/*" />
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
                                                                    <a href="javascript:void(0);"
                                                                        class="panel-action-btn clipboard"
                                                                        data-clipboard-text="setting('site.favicon')">
                                                                        <svg width="18px" version="1.1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            x="0px" y="0px" viewBox="0 0 1000 1000"
                                                                            enable-background="new 0 0 1000 1000"
                                                                            xml:space="preserve">
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
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-down.svg?v=1">

                                                                    </a>
                                                                    <a href="admin/setting/6/move-up"
                                                                        class="panel-action-btn" title="Move Up">
                                                                        <img
                                                                            src="../nanopkg-assets/image/setting/arrow-up.svg?v=1">

                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body mt-1 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input id="site.favicon" class="form-control"
                                                                            type="file" placeholder="Favicon"
                                                                            name="data[6]" accept="image/*" />
                                                                        <div class="my-1">
                                                                            Default image size 68x68
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                    </div>
                                                    <div class="d-flex justify-content-end mt-5">
                                                        <button type="submit" class="btn btn-success">Save
                                                            settings</button>
                                                    </div>

                                                </form>
                                                <span id="media-upload-url"
                                                    data-file-upload-url="admin/setting/file-upload"></span>
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
            <!--end  vue page -->
        </div>
    @endsection
