@extends('end-user.layout.app')

@section('title', 'جزئیات محتوا')

@section('content')
    <div class="page-heading text-center">
        <div class="container">
            <h2>{{$content->name}}</h2>
            <p class="breadcrumbs">
                <a href="{{url('/')}}">خانه</a>
                <i class="zmdi zmdi-chevron-left"></i>
                <a href="{{route('endUser.contents.index',['category_id' => request('category_id')])}}">
                    {{\App\Models\Category::all()->where('id',request('category_id'))->pluck('name')[0]}}
                </a>
                <i class="zmdi zmdi-chevron-left"></i>
                <a href="#">
                    {{$content->name}}
                </a>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9"> <img src="/user/assets/img/preview.jpg" alt="blog-single" class="resp-img">
                <h3>{{$content->name}}</h3>
                <div class="author"> <a href="#">نگار مختاری</a><span> - 2 آذر 1399</span> </div>
                <p class="abs">{{$content->description}}</p>
            </div>

        </div>
    </div>

@endsection

