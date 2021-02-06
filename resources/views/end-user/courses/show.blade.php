<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>جزئیات دوره</title>


    @include('end-user.layout._styles')
</head>

<body id="course-single" class="page">
<header>
    @include('end-user.layout._header')
</header>
<main>

    <div class="container">
        <div class="row">
            <div class="col-md-9 float-right"> <img src="/user/assets/img/test.jpg" alt="Course" class="resp-img course-preview">
                <h3>{{$course->name}}</h3>
                <p class="class-details">
{{--                    <span class="lessons"><i class="zmdi zmdi-assignment"></i>16 درس</span>--}}
{{--                    <span class="duration"><i class="zmdi zmdi-time"></i>7:15 ساعت</span>--}}
{{--                    <span class="views"><i class="zmdi zmdi-eye"></i>2562 نمایش</span>--}}
                    <span class="tag"><i class="zmdi zmdi-label"></i>{{$course->name}}</span>
                </p>
                <h4>جزئیات دوره</h4>
                <p class="abs">{!! $course->description !!}</p>

                <h4>محتوای دوره</h4>
                <ul class="course-accordion">
                    @foreach($parts as $part)
                        <li class="accordion-option ">
                        <div class="option-title">{{$part->name}}
{{--                            <span>(4 درس)</span>--}}
                        </div>
                        <div class="option-wrapper">
                            <ul class="option-items">
                                @foreach($lessons as $lesson)
                                    @if($part->id == $lesson->part_id)
                                    <li class="option-item">
                                    <div class="pull-right"> <span class="duration">0:15 ساعت</span>
                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                    </div>
                                    <a href="#">{{$lesson->name}}</a> </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 float-left">
                <div class="order text-center">
                    <h3 class="price">
                        @if($course->status == 1)
                            {{$course->price}}
                        @else
                            رایگان
                        @endif
                    </h3>
                    <p>قیمت تک</p>
                    <form action="{{route('user.cart.add',$course->id)}}" method="POST" id="add-to-cart">
                        @csrf
                    </form>
                    <a href="#" onclick="document.getElementById('add-to-cart').submit()"
                       class="greybutton">اضافه کردن به سبد خرید</a>

                </div>
                <div class="pros">
                    <h4>درباره مدرس</h4>
                    <div class="teacher text-center">
                        <div class="imgcontainer"> <img src="/user/assets/img/avatar/8.png" alt="Avatar">
                            <div class="overlay"> <img src="/user/assets/img/profile.png" alt="Profile">
                                <p>8 ویدیو</p>
                            </div>
                        </div>
                        <a href="#">آوینا زارعی</a>
                        <p>برنامه نویس فول استک</p>
                        <ul class="social">
                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li> <a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li> <a href="#"><i class="zmdi zmdi-google-old"></i></a></li>
                            <li> <a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                            <li> <a href="#"><i class="zmdi zmdi-email"></i></a></li>
                            <li> <a href="#"><i class="zmdi zmdi-globe-alt"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <br>
</main>
<footer>
    @include('end-user.layout._footer')
</footer>
@include('end-user.layout._scripts')
</body>
</html>
