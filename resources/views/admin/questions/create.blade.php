@extends('admin.layout.app')

@section('content')
    @if($errors->any())
        <div class="row">
            @foreach($errors->all() as $error)
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="alert alert-warning fade show" role="alert" style="height: 50px">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">{{$error}}</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            @endforeach
        </div>
    @endif
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    افزودن  سوال و پاسخ صحیح
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.questions.index',['course_id' => request('course_id'),'part_id'=>request('part_id'),
                                'lesson_id' => request('lesson_id'),'quiz_id' => request('quiz_id')])}}"
                   class="btn btn-label-brand ">
                    <i class="la la-arrow-right"></i>
                    <span class="kt-hidden-mobile"> بازگشت به سوال ها</span>
                </a>
            </div>
        </div>

        <!--begin::Form-->
        <form method="POST" action="{{route('admin.questions.store',['course_id' => request('course_id'),'part_id'=>request('part_id'),
                                        'lesson_id' => request('lesson_id'),'quiz_id' => request('quiz_id')])}}"
                                    class="kt-form">
            @csrf
            <div class="kt-portlet__body">
                <div class="kt-portlet--tabs">
                    <div class="tab-content">
                        <br>
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-11">
                                <div class="accordion accordion-solid accordion-toggle-plus" id="multiple_choice_mode_box">
                                    <div class="card">
                                        <div class="card-header" id="headingMultipleChoiceRow1">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#multiple_choice_mode_box_row1" aria-expanded="false" aria-controls="blank_mode_box_row1">
                                                <i class="fa fa-question-circle"></i>
                                                برای درج صورت سوال 4 گزینه ای کلیک کنید *الزامی
                                            </div>
                                        </div>
                                        <div id="multiple_choice_mode_box_row1" class="collapse" aria-labelledby="headingMultipleChoiceRow1" data-parent="#multiple_choice_mode_box">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-1 col-form-label" for="question">صورت سوال :</label>
                                                    <div class="col-lg-8">
                                                        <textarea name="question" id="question" class="form-control" rows="10" cols="20">{{ old('question') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingMultipleChoiceRow2">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#multiple_choice_mode_box_row2" aria-expanded="false" aria-controls="multiple_choice_mode_box_row2">
                                                <i class="fa fa-check-square"></i>
                                                برای درج گزینه  1 کلیک کنید*الزامی
                                            </div>
                                        </div>
                                        <div id="multiple_choice_mode_box_row2" class="collapse" aria-labelledby="headingMultipleChoiceRow2" data-parent="#multiple_choice_mode_box">
                                            <div class="card-body">
                                                <table class="table ">
                                                    <thead>
                                                    <tr>
                                                        <th> </th>
                                                        <th>آیا این گزینه پاسخ صحیح است؟</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="table-brand">
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="name">گزینه 1</label>
                                                                <textarea name="option1" id="option1" class="form-control" rows="1" cols="30">{{ old('option1') }}</textarea>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <label class="kt-radio kt-radio--bold kt-radio--success">
                                                                <input type="radio" name="correct_option" value="1">  بله
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingMultipleChoiceRow3">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#multiple_choice_mode_box_row3" aria-expanded="false" aria-controls="multiple_choice_mode_box_row3">
                                                <i class="fa fa-check-square"></i>
                                                برای درج گزینه  2 کلیک کنید
                                            </div>
                                        </div>
                                        <div id="multiple_choice_mode_box_row3" class="collapse" aria-labelledby="headingMultipleChoiceRow3" data-parent="#multiple_choice_mode_box">
                                            <div class="card-body">
                                                <table class="table ">
                                                    <thead>
                                                    <tr>
                                                        <th> </th>
                                                        <th>آیا این گزینه پاسخ صحیح است؟</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="table-brand">
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="name">گزینه 2</label>
                                                                <textarea name="option2" id="option2" class="form-control" rows="1" cols="30">{{ old('option2') }}</textarea>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <label class="kt-radio kt-radio--bold kt-radio--success">
                                                                <input type="radio" name="correct_option" value="2">  بله
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingMultipleChoiceRow4">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#multiple_choice_mode_box_row4" aria-expanded="false" aria-controls="multiple_choice_mode_box_row4">
                                                <i class="fa fa-check-square"></i>
                                                برای درج گزینه  3 کلیک کنید
                                            </div>
                                        </div>
                                        <div id="multiple_choice_mode_box_row4" class="collapse" aria-labelledby="headingMultipleChoiceRow4" data-parent="#multiple_choice_mode_box">
                                            <div class="card-body">
                                                <table class="table ">
                                                    <thead>
                                                    <tr>
                                                        <th> </th>
                                                        <th>آیا این گزینه پاسخ صحیح است؟</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="table-brand">
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="name">گزینه 3</label>
                                                                <textarea name="option3" id="option3" class="form-control" rows="1" cols="30">{{ old('option3') }}</textarea>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <label class="kt-radio kt-radio--bold kt-radio--success">
                                                                <input type="radio" name="correct_option" value="3">  بله
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingMultipleChoiceRow5">
                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#multiple_choice_mode_box_row5" aria-expanded="false" aria-controls="multiple_choice_mode_box_row5">
                                                <i class="fa fa-check-square"></i>
                                                برای درج گزینه  4 کلیک کنید
                                            </div>
                                        </div>
                                        <div id="multiple_choice_mode_box_row5" class="collapse" aria-labelledby="headingMultipleChoiceRow5" data-parent="#multiple_choice_mode_box">
                                            <div class="card-body">
                                                <table class="table ">
                                                    <thead>
                                                    <tr>
                                                        <th> </th>
                                                        <th>آیا این گزینه پاسخ صحیح است؟</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="table-brand">
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="name">گزینه 4</label>
                                                                <textarea name="option4" id="option4" class="form-control" rows="1" cols="30">{{ old('option4') }}</textarea>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <label class="kt-radio kt-radio--bold kt-radio--success">
                                                                <input type="radio" name="correct_option" value="4">  بله
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-success">ثبت اطلاعات</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

