@extends('admin.layout.auth')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
        <!--begin::Head-->
        <div class="kt-login__head">
            <span class="kt-login__signup-label">حساب کاربری ندارید؟</span>&nbsp;&nbsp;
            <a href="{{ route('register') }}" class="kt-link kt-login__signup-link">همین حالا ثبت نام کنید!</a>
        </div>
        <!--end::Head-->

        <!--begin::Body-->
        <div class="kt-login__body">

            <div class="kt-login__form">
                <div class="kt-login__title">
                    <h3>حساب کاربری خود را تائید کنید</h3>
                </div>

                @if (session('resent'))
                    <div role="alert" class="alert alert-success">
                        <div class="alert-text">
                            <div>لینک تائید حساب کاربری به ایمیل شما ارسال شد.</div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('verification.resend') }}" class="btn btn-primary btn-block">
                    ایمیلی دریافت نکرده اید؟
                </a>
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection
