<?php

namespace App\Http\Controllers\EndUser\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Part;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id','asc')->get();
        return view('end-user.courses.index',compact('courses'));
    }

    public function show(Course $course)
    {

        $lessons = Lesson::all();
        $parts = Part::where('course_id',request('course_id'))->get();
        return view('end-user.courses.show',[
            'course' => $course,
            'parts' => $parts,
            'lessons' => $lessons,
        ]);
    }
}
