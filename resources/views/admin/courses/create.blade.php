@extends('admin.layout.app')

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    افزودن  دوره
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.courses.index')}}" class="btn btn-label-brand ">
                    <i class="la la-arrow-right"></i>
                    <span class="kt-hidden-mobile"> بازگشت به دوره ها</span>
                </a>
            </div>
        </div>
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
    <!--begin::Form-->
        <form method="POST" action="{{route('admin.courses.store')}}" class="kt-form" enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label for="name">نام  </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                    <input type="checkbox"  name="money_status" value="money"  id="money_status" onclick="money()">  پولی
                    <span></span>
                </label>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="هزینه دوره را به ریال وارد کنید" style="display : none">
                        </div>
                    </div>

                </div>
                <br>
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                    <div class="card">
                        <div class="card-header" id="headingOne6">
                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                <i class="flaticon2-layers-1"></i>
                                <span>برای نوشتن مقاله کلیک کنید</span>
                            </div>
                        </div>
                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                            <div class="card-body">
                                <div class="form-group row" >
                                    <label class="col-lg-2 col-form-label" for="description">   توضیحات    :</label>
                                    <div class="col-lg-8">
                                        <textarea name="description" id="description" class="form-control" rows="10" cols="20">{{ old('description') }}</textarea>
                                        <span class="form-text text-muted">توضیحاتی پیرامون محتوا وارد نمایید</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">آپلود تصویر دوره </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">کاور را انتخاب کنید </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">آپلود فیلم معرفی دوره </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="video">
                            <label class="custom-file-label" for="customFile">فیلم موردنظر را انتخاب کنید </label>
                        </div>
                    </div>
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

@push('scripts')
    <script>
        function money()
        {
            var checkBox = document.getElementById("money_status");
            if (checkBox.checked == 1) {
                $('#price').show();
            }
            else {
                $('#price').hide();
            }
        }
        CKEDITOR.replace('description' ,{
        });


    </script>
@endpush
