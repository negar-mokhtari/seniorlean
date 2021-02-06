<?php

namespace App\Http\Controllers\Admin\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lesson\StoreRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::where('part_id',request('part_id'))
                    ->orderBy('id','asc')
                    ->get();
        return view('admin.lessons.index',compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $lesson = new Lesson();
        $lesson->part_id = request('part_id');
        $lesson->name = $request->get('name');
        $lesson->description = $request->get('description');
        $request->get('lesson_locked') == 'locked' ? $lesson->lock = 1 : $lesson->lock = 0;

        $video = $request->file('video');
        $video != null ? $video_name = pathinfo($video,PATHINFO_FILENAME) : '';
        $video != null ? $lesson->video = $video_name  . '.' .$video->getClientOriginalExtension() : '';

        $lesson->save();

        $video != null ? $video_store = '/public_html/'.'/storage/'.'lessons/' . $lesson->id .'/' . 'video/' .$video_name  . '.' .$video->getClientOriginalExtension() : '';
        $video != null ? Storage::disk('ftp')->put($video_store,fopen($request->file('video'),'r+')) : '';

        return redirect()->route('admin.lessons.index',['course_id' => request('course_id'),
                                            'part_id' => request('part_id')])->with('msg', 'اطلاعات با موفقیت درج شد!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
    }
}
