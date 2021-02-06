<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreRequest;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::where('category_id',request('category_id'))->get();
        return view('admin.contents.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $content = new Content();
        $content->category_id = request('category_id');
        $content->name = $request->get('name');
        $content->description = $request->get('description');

        $image = $request->file('image');
        $video = $request->file('video');

        $image != null ? $image_name = pathinfo($image,PATHINFO_FILENAME) : '';
        $video != null ? $video_name = pathinfo($video,PATHINFO_FILENAME) : '';

        $video != null ? $content->video = $video_name  . '.' .$video->getClientOriginalExtension() : '';
        $image != null ? $content->image = $image_name  . '.' .$image->getClientOriginalExtension() : '';

        $content->save();


        $image != null ? $image_store = '/public_html/'.'/storage/'.'contents/' .$content->id .'/' . 'image/' . $image_name  . '.' .$image->getClientOriginalExtension() : '';
        $image != null ? Storage::disk('ftp')->put($image_store,fopen($request->file('image'),'r+')) : '';


        $video != null ? $video_store = '/public_html/'.'/storage/'.'contents/' . $content->id .'/' . 'video/' .$video_name  . '.' .$video->getClientOriginalExtension() : '';
        $video != null ? Storage::disk('ftp')->put($video_store,fopen($request->file('video'),'r+')) : '';



        return redirect()->route('admin.contents.index',['category_id' => request('category_id')])
            ->with('msg', 'اطلاعات با موفقیت درج شد!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();
    }
}
