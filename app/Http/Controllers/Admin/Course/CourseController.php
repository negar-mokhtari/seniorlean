<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\StoreRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'asc')->get();
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $course = new Course();
        $course->name = $request->get('name');
        $course->description = $request->get('description');
        $course->status = $request->money_status == 'money' ? '1' : '0';
        if($request->money_status == 'money')
        {
            $course->price = $request->money_status == 'money' ? $request->get('price') : '';
        }
        $image = $request->file('image');
        $video = $request->file('video');

        $image != null ? $image_name = pathinfo($image,PATHINFO_FILENAME) : '';
        $video != null ? $video_name = pathinfo($video,PATHINFO_FILENAME) : '';

        $video != null ? $course->video = $video_name  . '.' .$video->getClientOriginalExtension() : '';
        $image != null ? $course->image = $image_name  . '.' .$image->getClientOriginalExtension() : '';

        $course->save();


        $image != null ? $image_store = '/public_html/'.'/storage/'.'courses/' .$course->id .'/' . 'image/' . $image_name  . '.' .$image->getClientOriginalExtension() : '';
        $image != null ? Storage::disk('ftp')->put($image_store,fopen($request->file('image'),'r+')) : '';


        $video != null ? $video_store = '/public_html/'.'/storage/'.'courses/' . $course->id .'/' . 'video/' .$video_name  . '.' .$video->getClientOriginalExtension() : '';
        $video != null ? Storage::disk('ftp')->put($video_store,fopen($request->file('video'),'r+')) : '';



        return redirect()->route('admin.courses.index')->with('msg', 'اطلاعات با موفقیت درج شد!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }
}
