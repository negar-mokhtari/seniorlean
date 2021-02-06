@extends('admin.layout.app')

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                @if(! request('lesson_id'))
                    <h3 class="kt-portlet__head-title">
                        افزودن  فلش کارت
                    </h3>
                @endif
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.cards.index',['group_id' => request('group_id')])}}" class="btn btn-label-brand ">
                    <i class="la la-arrow-right"></i>
                    <span class="kt-hidden-mobile"> بازگشت به فلش کارت ها </span>
                </a>
            </div>
        </div>

        <!--begin::Form-->
        <form method="POST" action="{{route('admin.cards.store',['group_id' => request('group_id')])}}" class="kt-form" enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label for="name">عنوان</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>درج جزئیات ستون ها</label>
                    <hr>
                    @foreach(array($group->columns)[0] as $item)
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="details">{{$item['name']}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="details[]" class="form-control" placeholder="جزئیات ستون "><br>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">آپلود تلفظ </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="voice">
                            <label class="custom-file-label" for="customFile">تلفظ را انتخاب کنید </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">آپلود تصویر کارت  </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">تصویر را انتخاب کنید </label>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-success">درج ردیف</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <!--end::Form-->

@endsection

