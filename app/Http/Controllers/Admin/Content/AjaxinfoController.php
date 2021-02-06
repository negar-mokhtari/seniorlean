<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class AjaxinfoController extends Controller
{
    public function getContents()
    {
        $contents = Content::all();
        return json_encode(array('data' => $contents));
    }
}
