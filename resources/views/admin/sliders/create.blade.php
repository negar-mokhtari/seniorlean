@extends('admin.layout.app')

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    افزودن  اسلاید
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.sliders.index')}}" class="btn btn-label-brand ">
                    <i class="la la-arrow-right"></i>
                    <span class="kt-hidden-mobile"> بازگشت به اسلاید ها</span>
                </a>
            </div>
        </div>

        <!--begin::Form-->
        <form method="POST" action="{{route('admin.sliders.store')}}" class="kt-form" enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">
                        عنوان
                    </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <label class="col-form-label col-lg-3 col-sm-12">آپلود عکس </label>
                    <div class=" col-lg-4 col-md-9 col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">عکس را انتخاب کنید </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-1"></div>

                    <label for="type_link" class="col-form-label col-lg-3 col-sm-12">
                        این لینک برای :
                    </label>
                    <div class="col-lg-4">
                        <select class="form-control kt-select2" onChange="choiceLink(this.value);"
                                id="Entities" name="Entities">
                            <option value="0">آیتم موردنظر را انتخاب کنید</option>
                            <option value="Course">دوره ها</option>
                            <option value="Lesson">درس ها</option>
                            <option value="Category">دسته بندی محتوا ها</option>
                            <option value="Content">محتوا ها</option>
                            <option value="Group">دسته بندی فلش کارت ها</option>
                            {{--                                    <option value="6"> لیست ها</option>--}}
                        </select>
                    </div>
                    <div class="col-lg-3">
                                <span>لطفا با دقت انتخاب کنید.
                                    اگر بعد از کلیک کردن
                                    <span style="color: red">تصمیم به تغییر گرفتید </span>
                                    صفحه را مجددا رفرش کرده و مجددا آیتم مورد نظر را انتخاب کنید.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <select class="form-control kt-select2"
                                id="Entities_detail" name="Entities_detail">
                        </select>
                    </div>
                    <div class="col-lg-3">
                                <span>درصورت انتخاب لینک

                                    <span style="color: red">هر دو مورد الزامی هستند*</span>
                                   </span>
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
        function choiceLink(state)
        {
            with(document.getElementById('Entities_detail'))
            {
                switch(state) {
                    case 0:
                        options[0] = new Option('آیتم موردنظر را انتخاب کنید' , '0');
                        break;
                    case 'Course':
                        options[0] = new Option('جزئیات آیتم موردنظر را انتخاب کنید' , '0');
                        $.ajax
                        ({
                            type: "POST",
                            dataType: "json",
                            url: "{{route('admin.courses.ajax')}}",
                            data: {
                                _token:'{{ csrf_token() }}'
                            },
                            cache: false,
                            success: function(response){
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }
                                if(len > 0){
                                    for(var i=0; i<len; i++){
                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name;
                                        options[id] = new Option(name , id);
                                        $("#Entities_detail").append(options[id]);
                                    }
                                }else{
                                    options[0] = new Option('اطلاعات یافت نشد' , '0');
                                }
                            }
                        });
                        break;
                    case 'Lesson':
                        options[0] = new Option('جزئیات آیتم موردنظر را انتخاب کنید' , '0');
                        $.ajax
                        ({
                            type: "POST",
                            dataType: "json",
                            url: "{{route('admin.lessons.ajax')}}",
                            data: {
                                _token:'{{ csrf_token() }}'
                            },
                            cache: false,
                            success: function(response){
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }
                                if(len > 0){
                                    for(var i=0; i<len; i++){
                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name;
                                        options[id] = new Option(name , id);
                                        $("#Entities_detail").append(options[id]);
                                    }
                                }else{
                                    options[0] = new Option('اطلاعات یافت نشد' , '0');
                                }
                            }
                        });
                        break;
                    case 'Category':
                        options[0] = new Option('جزئیات آیتم موردنظر را انتخاب کنید' , '0');
                        $.ajax
                        ({
                            type: "POST",
                            dataType: "json",
                            url: "{{route('admin.categories.ajax')}}",
                            data: {
                                _token:'{{ csrf_token() }}'
                            },
                            cache: false,
                            success: function(response){
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }
                                if(len > 0){
                                    for(var i=0; i<len; i++){
                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name;
                                        options[id] = new Option(name , id);
                                        $("#Entities_detail").append(options[id]);
                                    }
                                }else{
                                    options[0] = new Option('اطلاعات یافت نشد' , '0');
                                }
                            }
                        });
                        break;
                    case 'Content':
                        options[0] = new Option('جزئیات آیتم موردنظر را انتخاب کنید' , '0');
                        $.ajax
                        ({
                            type: "POST",
                            dataType: "json",
                            url: "{{route('admin.contents.ajax')}}",
                            data: {
                                _token:'{{ csrf_token() }}'
                            },
                            cache: false,
                            success: function(response){
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }
                                if(len > 0){
                                    for(var i=0; i<len; i++){
                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name;
                                        options[id] = new Option(name , id);
                                        $("#Entities_detail").append(options[id]);
                                    }
                                }else{
                                    options[0] = new Option('اطلاعات یافت نشد' , '0');
                                }
                            }
                        });
                        break;
                    case 'Group':
                        options[0] = new Option('جزئیات آیتم موردنظر را انتخاب کنید' , '0');
                        $.ajax
                        ({
                            type: "POST",
                            dataType: "json",
                            url: "{{route('admin.groups.ajax')}}",
                            data: {
                                _token:'{{ csrf_token() }}'
                            },
                            cache: false,
                            success: function(response){
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }
                                if(len > 0){
                                    for(var i=0; i<len; i++){
                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name;
                                        options[id] = new Option(name , id);
                                        $("#Entities_detail").append(options[id]);
                                    }
                                }else{
                                    options[0] = new Option('اطلاعات یافت نشد' , '0');
                                }
                            }
                        });
                        break;
                    default:
                        options[0] = new Option('آیتم موردنظر را انتخاب کنید' , '0');
                }
            }
        }
    </script>


    <script>
        $("#Entities").select2({
            placeholder : 'آیتم موردنظر را انتخاب کنید'
        });
        $("#Entities_detail").select2({
            placeholder : 'آیتم موردنظر را انتخاب کنید'
        });
    </script>

@endpush
