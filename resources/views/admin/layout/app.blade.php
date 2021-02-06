@extends('admin.layout.master')

@section('root')
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="#">
                <img alt="Logo" src="/admin/assets/media/logos/logo-6-sm.png" style="width:32px; height: 47px"/>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <div class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></div>
            <div class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></div>
            <div class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></div>
        </div>
    </div>
    <!-- end:: Header Mobile -->

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <!-- begin:: Aside -->
        @include('admin.layout._sidebar')

        <!-- end:: Aside -->

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            @include('admin.layout._header')
            <!-- end:: Header -->

                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                    <!-- begin:: Subheader -->
                @yield('header')
                <!-- end:: Subheader -->

                    <!-- begin:: Content -->
                    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>

                <!-- begin:: Footer -->
            @include('admin.layout._footer')
            <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- begin::ScrollTop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::ScrollTop -->
@endsection
