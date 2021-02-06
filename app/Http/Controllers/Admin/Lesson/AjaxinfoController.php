<?php

namespace App\Http\Controllers\Admin\Lesson;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AjaxinfoController extends Controller
{
    public function getLessons()
    {
        $lessons = Lesson::all();
        return json_encode(array('data' => $lessons));
    }
}
