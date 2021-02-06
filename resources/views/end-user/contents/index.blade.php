@extends('end-user.layout.app')

@section('title', 'لیست محتوا')

@section('content')
    <div class="page-heading text-center">
        <div class="container">
            <h2>{{\App\Models\Category::all()->where('id',request('category_id'))->pluck('name')[0]}}</h2>
            <p class="breadcrumbs">
                <a href="{{url('/')}}">خانه</a>
                <i class="zmdi zmdi-chevron-left"></i>
                <a href="{{route('endUser.contents.index',['category_id' => request('category_id')])}}">
                    {{\App\Models\Category::all()->where('id',request('category_id'))->pluck('name')[0]}}
                </a>
            </p>
        </div>
    </div>

    <div class="container courses-browse popular">
        <div class="row tutorials">
            @foreach($contents as $content)
                <div class="col-md-3 col-sm-6">
                <div class="tutorial"> <img src="/user/assets/img/popular/5.jpg" class="resp-img" alt="Tutorial">
                    <div class="tutorial-details">
                        <h6>{{$content->name}}</h6>
{{--                        <p><span class="lessons"><i class="zmdi zmdi-assignment"></i>12 درس</span><span class="duration"><i class="zmdi zmdi-time"></i>3:15 ساعت</span></p>--}}
                        <p class="abs">{{\Illuminate\Support\Str::limit($content->description,35,'...')}}</p>
                        <a href="{{route('endUser.contents.show', [$content->id,'category_id' => request('category_id')])}}" class="greybutton">
                            نمایش جزئیات</a> </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



@endsection
