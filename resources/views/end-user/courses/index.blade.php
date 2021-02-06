@extends('end-user.layout.app')

@section('title', 'لیست دوره ها')

@section('content')
    <div class="page-heading text-center">
        <div class="container">
            <h2>لیست دوره ها</h2>
            <p class="breadcrumbs">
                <a href="{{url('/')}}">خانه</a>
                <i class="zmdi zmdi-chevron-left"></i>
                <a href="{{route('endUser.courses.index')}}">
                    لیست دوره ها
                </a>
            </p>
        </div>
    </div>


    <div class="container courses-browse popular">
        <div class="row tutorials">
            @foreach($courses as $course)
                <div class="col-md-3 col-sm-6">
                    <div class="tutorial"> <img src="/user/assets/img/popular/5.jpg" class="resp-img" alt="Tutorial">
                        <div class="tutorial-details">
                            <h6>{{$course->name}}</h6>
                                <p><span class="lessons"><i class="zmdi zmdi-assignment"></i>12 بخش</span><span class="duration"><i class="zmdi zmdi-time"></i>3:15 ساعت</span></p>
                            <a href="{{route('endUser.courses.show', [$course->id,'course_id' => $course->id])}}" class="greybutton">
                                نمایش جزئیات</a> </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



@endsection
