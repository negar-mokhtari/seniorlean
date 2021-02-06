<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.sliders.create',[
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->get('title');

        $link = $this->dictionaryLinksOfApp($request->Entities , $request->Entities_detail);
        $slider->link = $link;
        $slider->link_id = $request->Entities_detail;
        $image = $request->file('image');

        if($image != null)
        {
            $image_name = pathinfo($image,PATHINFO_FILENAME) ;
            $slider->image = $image_name  . '.' .$image->getClientOriginalExtension();
        }

        $slider->save();

        if($image != null)
        {
            $image_store = '/public_html/'.'/storage/'.'sliders/' .$slider->id .'/'  . $image_name  . '.' .$image->getClientOriginalExtension();
            Storage::disk('ftp')->put($image_store,fopen($request->file('image'),'r+'));
        }
        return redirect()->route('admin.sliders.index')->with('msg', 'اطلاعات با موفقیت درج شد!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
    }

    protected function dictionaryLinksOfApp($linkype,$id)
    {
        $links = [
            'Course' => 'http://seniorlearn.ir/courses/'. $id,
            'Category' => 'http://seniorlearn.ir/categories/'. $id,
            'Content' =>  'http://seniorlearn.ir/contents/'. $id,
            'Group' => 'http://seniorlearn.ir/groups/'. $id,
        ];
        switch ($linkype) {
            case 'Course':
                return $links['Course'];
                break;
            case 'Lesson':
                return $links['Lesson'];
                break;
            case 'Category':
                return $links['Category'];
                break;
            case 'Group':
                return $links['Group'];
                break;
            default:
                return 'null';

        }
    }
}
