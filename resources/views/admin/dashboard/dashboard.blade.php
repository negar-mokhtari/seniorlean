@extends('admin.layout.app')

@section('content')
    @push('styles')
        <link href="/admin/assets/css/pages/general/invoices/invoice-1.css" rel="stylesheet" type="text/css" />
    @endpush
<div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    سلام
                    {{auth()->user()->first_name}}
                    خوش آمدید
                </h3>
            </div>
            <button type="button" class="btn  btn-pill disabled" >
                <iframe src="http://free.timeanddate.com/clock/i7lveguq/n246/fn2/fs22/ftb/th1"
                        frameborder="0" width="105" height="30">

                </iframe>
            </button>
            <div class="kt-portlet__head-toolbar">
                <button type="button" class="btn btn-secondary btn-elevate btn-pill"><i class="fa fa-calendar-check"></i>
                    {{\Hekmatinasser\Verta\Verta::now()->formatDate()}}
                </button>
                <button type="button" class="btn btn-secondary btn-elevate btn-pill"><i class="fa fa-calendar-check"></i>
                    {{\Hekmatinasser\Verta\Verta::now()->formatGregorian('Y-m-d')}}
                </button>

            </div>
        </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-invoice-1">
                    <div class="kt-invoice__wrapper">
{{--                        <div class="kt-invoice__head" style="background-image: url('/admin/assets/media/bg/3.jpg');filter: hue-rotate(305deg);">--}}
{{--                            <div class="kt-invoice__container kt-invoice__container--centered">--}}
{{--                                <span class="kt-invoice__desc">--}}
{{--                                    <br>--}}
{{--                                <h1 style="color: white" class="kt-invoice__subtitle">سلام--}}
{{--                                    {{auth()->user()->first_name}}--}}
{{--                                    خوش آمدید</h1>--}}
{{--                                </span>--}}
{{--                                <div class="kt-invoice__items">--}}
{{--                                    <div class="kt-invoice__item">--}}
{{--                                        <span class="kt-invoice__subtitle">امروز</span>--}}
{{--                                        <span class="kt-invoice__subtitle" >--}}
{{--                                            {{\Hekmatinasser\Verta\Verta::now()->formatDate()}}--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-invoice__item">--}}
{{--                                        <span class="kt-invoice__subtitle">today</span>--}}
{{--                                        <span class="kt-invoice__subtitle">--}}
{{--                                        {{\Hekmatinasser\Verta\Verta::now()->formatGregorian('Y-m-d')}}--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-invoice__item">--}}
{{--                                        <span class="kt-invoice__subtitle">time</span>--}}
{{--                                        <span class="kt-invoice__subtitle">--}}
{{--                                        <iframe src="http://free.timeanddate.com/clock/i73esa6z/n246/fcfff/tc7a39e5/pc7a39e5/th1" frameborder="0" width="57" height="19"></iframe>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="kt-portlet__body  kt-portlet__body--fit">
                            <div class="row row-no-padding row-col-separator-xl">
                                <div class="col-md-12 col-lg-6 col-xl-3" >
                                    <!--begin::Total Profit-->
                                    <div class="kt-widget24" style="background-color: #7ea4b4">
                                        <div class="kt-widget24__details">
                                            <div class="kt-widget24__title">
                                                <i class="fa fa-user fa-5x" style="color: #1B5C78"></i>
                                                <h5 class="kt-widget24__title" style="color: white">

                                                    کاربران امروز
                                                </h5>
                                            </div>
                                            <span class="kt-widget24__stats" style="color: white">
                                                    20
                                            </span>
                                        </div>
{{--                                        <div class="progress progress--sm">--}}
{{--                                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <!--end::Total Profit-->
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-3" >
                                    <!--begin::Total Profit-->
                                    <div class="kt-widget24" style="background-color: #9BE4B9">
                                        <div class="kt-widget24__details">
                                            <div class="kt-widget24__danger">
                                                <i class="fa fa-cart-arrow-down fa-5x" style="color: #1B8345"></i>
                                                <h5 class="kt-widget24__title" style="color: white">

                                                    سفارشات امروز
                                                </h5>
                                            </div>
                                            <span class="kt-widget24__stats" style="color: white">
                                                    25
                                                </span>
                                        </div>
{{--                                        <div class="progress progress--sm">--}}
{{--                                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <!--end::Total Profit-->
                                </div>


                                <div class="col-md-12 col-lg-6 col-xl-3" >
                                    <!--begin::Total Profit-->
                                    <div class="kt-widget24" style="background-color: #A2ABE1">
                                        <div class="kt-widget24__details">
                                            <div class="kt-widget24__danger">
                                                <i class="fa fa-comment-dollar fa-5x" style="color: #1F2C7F"></i>
                                                <h5 class="kt-widget24__title" style="color: white">

                                                    فروش امروز
                                                </h5>
                                            </div>
                                            <span class="kt-widget24__stats" style="color: white">
                                                    25
                                                </span>
                                        </div>
{{--                                        <div class="progress progress--sm">--}}
{{--                                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <!--end::Total Profit-->
                                </div>


                                <div class="col-md-12 col-lg-6 col-xl-3" >
                                    <!--begin::Total Profit-->
                                    <div class="kt-widget24" style="background-color: #80C0DC">
                                        <div class="kt-widget24__details">
                                            <div class="kt-widget24__danger">
                                                <i class="fa fa-search-dollar fa-5x" style="color: #1B5C78"></i>
                                                <h5 class="kt-widget24__title" style="color: white">

                                                    سود امروز
                                                </h5>
                                            </div>
                                            <span class="kt-widget24__stats" style="color: white">
                                                    25
                                                </span>
                                        </div>
{{--                                        <div class="progress progress--sm">--}}
{{--                                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <!--end::Total Profit-->
                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
