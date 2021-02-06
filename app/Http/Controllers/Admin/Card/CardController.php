<?php

namespace App\Http\Controllers\Admin\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Card\StoreRequest;
use App\Models\Card;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::where('group_id',request('group_id'))
                        ->orderBy('id','asc')
                        ->get();
        $group = Group::where('id',request('group_id'))->first();
        return view('admin.cards.index',[
            'cards' => $cards,
            'group' => $group
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = Group::where('id',request('group_id'))->first();
        return view('admin.cards.create',compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $card = new Card();
        $card->group_id = request('group_id');
        $card->name = $request->get('name');
        $card->details = $request->details;

        $voice = $request->file('voice');
        $voice != null ? $voice_name = pathinfo($voice,PATHINFO_FILENAME) : '';
        $voice != null ? $card->voice = $voice_name  . '.' .$voice->getClientOriginalExtension() : '';

        $image = $request->file('image');
        $image != null ? $image_name = pathinfo($image,PATHINFO_FILENAME) : '';
        $image != null ? $card->image = $image_name  . '.' .$image->getClientOriginalExtension() : '';

        $card->save();

        $voice != null ? $voice_store = '/public_html/'.'/storage/'.'cards/' .$card->id .'/' . 'voice/' . $voice_name  . '.' .$voice->getClientOriginalExtension() : '';
        $voice != null ? Storage::disk('ftp')->put($voice_store,fopen($request->file('voice'),'r+')) : '';

        $image != null ? $image_store = '/public_html/'.'/storage/'.'cards/' .$card->id .'/' . 'image/' . $image_name  . '.' .$image->getClientOriginalExtension() : '';
        $image != null ? Storage::disk('ftp')->put($image_store,fopen($request->file('image'),'r+')) : '';

        return redirect()->route('admin.cards.index',['group_id' => request('group_id')])
            ->with('msg', 'اطلاعات با موفقیت درج شد!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
    }
}
