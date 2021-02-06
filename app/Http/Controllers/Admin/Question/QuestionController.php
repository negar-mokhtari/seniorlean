<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\StoreRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('quiz_id',request('quiz_id'))
            ->orderBy('id','asc')
            ->get();
        return view('admin.questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $question = new Question();
        $question->quiz_id = request('quiz_id');
        $question->question = $request->get('question');
        switch ($request->get('correct_option'))
        {
            case "1":
                $question->answer = 1;
                break;
            case "2":
                $question->answer = 2;
                break;
            case "3":
                $question->answer = 3;
                break;
            case "4":
                $question->answer = 4;
                break;
        }

        $question->option1 = $request->get('option1');
        $question->option2 = $request->get('option2');
        $question->option3 = $request->get('option3');
        $question->option4 = $request->get('option4');
        $question->save();

        return redirect()->route('admin.questions.index',
            [
                'course_id' => request('course_id') , 'part_id' => request('part_id') ,
                'lesson_id' => request('lesson_id') , 'quiz_id' => request('quiz_id')
            ])->with('msg', 'اطلاعات با موفقیت درج شد!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
    }
}
