<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>senior learn</title>

    @stack('styles')

    @include('end-user.layout._styles')

    <script src="/user/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/user/assets/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body id="index1" class="homepage">
<header>


    <div class="container">
        <div class="container">
            <div id="topbar">
                <div class="pull-right">
                    <div class="navigation">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <i class="zmdi zmdi-menu zmdi-hc-lg"></i>
                        </button>
                        <nav class="collapse navbar-collapse" id="myNavbar">
                            <ul>
                                <li class="active"> <a href="">خانه</a>
                                </li>
                                <li> <a href="#">دسته بندی ها</a>
                                    <ul class="submenu clearfix">
                                        <li>
                                            <ul class="sub-column">
                                                <li>  محتوا </li>
                                                @foreach(\App\Models\Category::all() as $category)
                                                    <li><a href="{{route('endUser.contents.index',['category_id' => $category->id])}}">{{$category->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <ul class="sub-column">
                                                <li> فلش کارت ها </li>
                                                @foreach(\App\Models\Group::all() as $group)
                                                    <li><a href="#">{{$group->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li> <a href="#">دوره ها</a>
                                    <ul class="submenu submenu-list">
                                        <li><a href="{{route('endUser.courses.index')}}"> لیست دوره ها</a></li>
                                        @foreach(\App\Models\Course::all() as $course)
                                            <li><a href="{{route('endUser.courses.show', [$course->id,'course_id' => $course->id])}}">{{$course->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li><a href="#">تماس با ما</a></li>
                            </ul>
                        </nav>

                    </div>

                    @if(! auth()->check())
                        <a href="{{route('login')}}" class="blueplay login">ورود</a>
                    @else
                        <a href="{{route('user.dashboard')}}" class="blueplay login">پروفایل من</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="blueplay login">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            خروج
                        </a>
                    @endif
                    <div class="cart"> <a href="#"><i class="zmdi zmdi-case zmdi-hc-lg"></i><span>2</span></a>
                        <div class="cart-container">
                            <h6>سبد خرید </h6>
                            @foreach(\Cart::all() as $cart)
                                @if(isset($cart['course']))
                                    @php
                                        $course = $cart['course']
                                    @endphp
                                    <div class="cart-item clearfix">
                                        <img src="/user/assets/img/cart1.jpg" alt="cart item" class="pull-left">
                                        <a href="#">{{$course->name}}</a>
                                        <p class="quantity">تومان {{ $course->price * $cart['quantity'] }}</p>
{{--                                        <button class="remove">x حذف</button>--}}
                                    </div>
                                @endif
                            @endforeach
                            <div class="text-right mt-4">
                                <label class="text-muted font-weight-normal m-0">قیمت کل</label>

                                @php
                                    $totalPrice = Cart::all()->sum(function($cart) {
                                        return $cart['price'] * $cart['quantity'];
                                    });
                                @endphp
                                <div class="text-large"><strong>{{ $totalPrice }} تومان</strong></div>
                            </div>
                            <div class="cart-controls text-center">
                                <a href="#" class="checkout">پرداخت</a>
                                {{--                            <a href="{{route('cart.show')}}" class="viewcart">نمایش سبد</a>--}}
                                <a href="#" class="addcourse">افزودن دوره</a> </div>
                        </div>
                    </div>
                </div>
                <h1 class="logo"><a class="no-text-decoration-white" href="{{url('/')}}">
                        <h1>سینیور لرن</h1>
                    </a>
                </h1>

            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <p class="pretitle">آموزش آنلاین ویدیویی</p>
                    <h2 class="wow pulse">توانایی هاتو افزایش بده</h2>
                    <p>روزانه هرچیز جدیدی که میخواهید را میتوانید در سینیور لرن یاد بگیرید.</p>
                    <a href="{{route('login')}}" class="bluebutton wow fadeInDown">ثبت نام کنید و یادگیری را آغاز کنید.</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="rslides-header">

        <li><img src="/user/assets/img/slide-2.jpg" class="resp-img" alt="Slide"></li>
        <li><img src="/user/assets/img/slide-1.jpg" class="resp-img" alt="Slide"></li>
        {{--    @foreach(\App\Models\Slider::all() as $slider)--}}
        {{--        <li><img src="http://seniorlearn.ir/sliders/{{$slider->id}}/image/{{$slider->image}}" class="resp-img" alt="Slide"></li>--}}
        {{--    @endforeach--}}
    </ul>
    <a href="#" class="popular-scrolldown"><span></span></a>


</header>
<main>
    <div class="features-carousel wow fadeInUp">
       @include('end-user.layout._features')
    </div>
    <div class="container categories text-center">
       @include('end-user.layout._categories')
    </div>
    <div class="container success">
        @include('end-user.layout._steps')
    </div>
    <div class="container-fluid signup text-center">
        <div class="row">
            <div class="col-sm-12">
                <p class="wow fadeIn" data-wow-delay="0.3s">آموزش آنلاین در هرکجا</p>
                <h4 class="wow tada" data-wow-delay="0.5s">آیا آماده شروع یادگیری هستید؟</h4>
                <a href="{{route('login')}}" class="bluebutton wow shake" data-wow-delay="1s">همین امروز ثبت نام کنید</a> </div>
        </div>
    </div>
    <div class="container popular">
        <div class="row">
            <div class="col-sm-12 text-center margin-top-50 wow fadeInUpBig" data-wow-delay="0.5s">
                <h3>محبوب ترین آموزش های آنلاین</h3>
                <div class="scrolldown-placeholder">
                    <a href="#" class="popular-scrolldown">
                        <i class="zmdi zmdi-chevron-down zmdi-hc-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row tutorials">
           @include('end-user.layout._courses')
        </div>
    </div>

</main>
<footer>
    @include('end-user.layout._footer')
</footer>
@include('end-user.layout._scripts')
</body>
</html>
