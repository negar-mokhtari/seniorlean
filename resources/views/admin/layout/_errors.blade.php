<!DOCTYPE html>

<html lang="en" direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>Senior Learn</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/admin/assets/media/logos/logo-6-sm.png" type="image/icon type">
    <!--begin::Fonts -->
    <link rel="stylesheet" href="/admin/assets/vendors/general/iransans/css/fontiran.css"/>
    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
@stack('styles')
<!--end::Page Vendors Styles -->

    <!--begin::Global Styles -->
@include('admin.layout._styles')
<!--end::Global Styles -->

    <!--begin::Favicon -->
{{--@include('layout._icons')--}}
<!--end::Favicon -->
</head>
<!-- end::Head -->

<!-- begin::Body -->
@yield('root')


<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
@include('admin.layout._config')
<!-- end::Global Config -->

<!-- begin::Global Scripts -->
@include('admin.layout._scripts')
<!-- end::Global Scripts -->

<!--begin::Page Vendors(used by this page) -->
@stack('vendors')
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
@stack('scripts')
<!--end::Page Scripts -->

{{--@include('sweet::alert')--}}
</body>

<!-- end::Body -->
</html>
