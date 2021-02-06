
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
                            <li class="active"> <a href="{{url('/')}}">خانه</a>
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
                                        <form action="{{ route('user.cart.destroy' , $cart['id']) }}" id="delete-cart-{{ $course->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button class="remove" onclick="event.preventDefault();document.getElementById('delete-cart-{{ $course->id }}').submit()">x حذف</button>
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
                            <form action="{{ route('user.cart.payment') }}" method="post" id="cart-payment">
                                @csrf
                            </form>
                            <button onclick="document.getElementById('cart-payment').submit()" class="checkout">پرداخت</button>

                    </div>
                </div>
            </div>
            <h1 class="logo"><a class="no-text-decoration-white" href="#">
                    <h1>سینیور لرن</h1>
                </a>
            </h1>

        </div>
    </div>
</div>

