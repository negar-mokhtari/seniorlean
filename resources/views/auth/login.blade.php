@extends('admin.layout.auth')

@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Sign In To Senior Learn</h3>
        </div>
        <form class="kt-form" action="{{route('login')}}" method="POST">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="ایمیل" name="email" autocomplete="off">
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="پسورد" name="password">
            </div>
            <div class="row kt-login__extra">
                <div class="col">
                    <label class="kt-checkbox">
                        <input type="checkbox" name="remember"> مرا به خاطر بسپار
                        <span></span>
                    </label>
                </div>
                <div class="col kt-align-right">
                    <a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">رمز عبور را فراموش کرده اید؟</a>
                </div>
            </div>
            {{--<div class="kt-login__actions">--}}
                {{--<button id="kt_login_signup_submit" class="btn btn-pill kt-login__btn-primary">ورود</button>&nbsp;&nbsp;--}}
            {{--</div>--}}
                <button  type="submit" class="btn btn-light btn-elevate btn-pill">ورود</button>

        </form>
    </div>
    <div class="kt-login__signup">
        <div class="kt-login__head">
            <h3 class="kt-login__title">ورود</h3>
            <div class="kt-login__desc">برای ورود به سایت لطفا اطلاعات را وارد کنید</div>
        </div>
        <form class="kt-form" method="POST" action="{{route('register')}}">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="نام" name="first_name">
            </div>
            <div class="input-group">
                <input class="form-control" type="text" placeholder=" نام خانوادگی" name="last_name">
            </div>
            <div class="input-group">
                <input class="form-control" type="text" placeholder="ایمیل" name="email" autocomplete="off">
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="پسورد" name="password">
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="پسورد را مجددا وارد کنید" name="password_confirmation">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="شماره موبایل خود را وارد کنید" name="phone">
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label class="kt-radio kt-radio--bold kt-radio--primary">
                        <h5>boy</h5>
                        <input type="radio" name="gender" value="boy">
                        <span></span>
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="kt-radio kt-radio--bold kt-radio--primary">
                        <h5>girl</h5>
                        <input type="radio" name="gender" value="girl">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="row kt-login__extra">
                <div class="col kt-align-left">
                    <label class="kt-checkbox">
                        <input type="checkbox" name="agree">من موافق<a href="#" class="kt-link kt-login__link kt-font-bold">قوانین سایت </a>هستم.
                        <span></span>
                    </label>
                    <span class="form-text text-muted"></span>
                </div>
            </div>

            <button  type="submit" class="btn  btn-light btn-elevate btn-pill" >ثبت نام</button>
            <button id="kt_login_signup_cancel" class="kt-login__actions btn btn-light btn-elevate btn-pill">انصراف</button>

        </form>
    </div>
    <div class="kt-login__forgot">
        <div class="kt-login__head">
            <h3 class="kt-login__title">رمز عبور را فراموش کرده اید؟</h3>
            <div class="kt-login__desc">برای بازگشت پسورد لطفا ایمیل خود را وارد کنید</div>
        </div>
        <form class="kt-form" action="">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="ایمیل" name="email" id="kt_email" autocomplete="off">
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_forgot_submit" class="btn  btn-light btn-elevate btn-pill">درخواست</button>&nbsp;&nbsp;
                <button id="kt_login_forgot_cancel" class="btn  btn-light btn-elevate btn-pill">انصراف</button>
            </div>
        </form>
    </div>
    <div class="kt-login__account">
								<span class="kt-login__account-msg">
									هنوز ثبت نام نکرده اید؟
								</span>&nbsp;&nbsp;
        <a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link">ثبت نام</a>
    </div>
@endsection
