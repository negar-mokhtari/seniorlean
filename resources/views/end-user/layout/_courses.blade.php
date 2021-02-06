@foreach(\App\Models\Course::limit(3)->get() as $course)

    <div class="col-md-4">
        <div class="tutorial wow fadeInRightBig" data-wow-delay="0.8s"> <img src="/user/assets/img/popular/303.jpg" class="resp-img" alt="Tutorial">
            <div class="tutorial-details">
                <h6>{{$course->name}}</h6>
                <p><span class="lessons"><i class="zmdi zmdi-assignment"></i>12 بخش</span><span class="duration"><i class="zmdi zmdi-time"></i>3:15 ساعت</span></p>
{{--                <p class="abs">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که.</p>--}}
                <a href="#" class="greybutton">نمایش دوره</a> </div>
        </div>
    </div>

@endforeach

