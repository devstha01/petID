<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{ asset('admin/assets/vendors/base/vendors.bundle.css' ) }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/assets/demo/demo12/base/style.bundle.css' ) }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->

    @stack('styles')

    <link href="{{ asset('admin/css/style.css' ) }}" rel="stylesheet" type="text/css"/>

    <!--end::Page Vendors Styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/app/media/img/icons/favicon.ico' ) }}" />
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    @include('admin.partials.header')

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        @include('admin.partials.sidebar')

        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title">@yield('title')</h3>
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->

            <div class="m-content">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- end:: Body -->

    @include('admin.partials.footer')
</div>
<!-- end:: Page -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!--begin::Global Theme Bundle -->
<script src="{{ asset('admin/assets/vendors/base/vendors.bundle.js' ) }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/demo/demo12/base/scripts.bundle.js' ) }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

@stack('scripts')
</body>

<!-- end::Body -->
</html>