<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AjaxinfoController extends Controller
{
    public function getCourses()
    {
        $courses = Course::all();
        return json_encode(array('data' => $courses));
    }
}
