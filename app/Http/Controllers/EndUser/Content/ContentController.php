<?php

namespace App\Http\Controllers\EndUser\Content;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::where('category_id',request('category_id'))->orderBy('id','asc')->get();
        return view('end-user.contents.index',compact('contents'));
    }

    public function show(Content $content)
    {
        return view('end-user.contents.show',compact('content'));
    }
}
