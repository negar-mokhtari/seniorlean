@extends('admin.layout.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/custom/datatables/datatables.bundle.rtl.css"/>
@endpush

@section('content')
    @if(session()->get('msg') != null)
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success fade show" role="alert" style="height: 50px">
                    <div class="alert-icon"><i class="fa fa-check-circle"></i></div>
                    <div class="alert-text">{{session()->get('msg')}}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    @endif
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <a href="{{route('admin.courses.index')}}">
                        دوره ها:
                    </a>
                    {{\App\Models\Course::all()->where('id',request('course_id'))->pluck('name')[0]}}
                    <i class="fa fa-angle-double-left"></i>
                    <a href="{{route('admin.parts.index',['course_id' => request('course_id')])}}">
                        بخش ها:
                    </a>
                    {{\App\Models\Part::all()->where('id',request('part_id'))->pluck('name')[0]}}
                    <i class="fa fa-angle-double-left"></i>
                    <a href="{{route('admin.lessons.index',['course_id' => request('course_id') , 'part_id' => request('part_id')])}}">
                        درس ها
                    </a>

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.lessons.create',['course_id' => request('course_id'), 'part_id' => request('part_id')])}}" class="btn btn-label-brand">
                    افزودن  درس
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="table_lessons" class="table table-bordered table-advance table-hover table-responsive-lg" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>قفل</th>
                    <th>نام </th>
                    <th>توضیحات </th>
                    <th>فیلم</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{$lesson->id}}</td>
                        <td>
                            @if($lesson->lock == '0')
                                خیر
                            @endif
                            @if($lesson->lock == '1')
                                بله
                            @endif
                        </td>
                        <td>{{$lesson->name}}</td>
                        <td>
                            @if($lesson->description != null)
                                دارد
                            @else
                                ندارد
                            @endif
                        </td>
                        <td>
                            @if($lesson->video != null)
                                دارد
                            @endif
                            @if($lesson->video == null)
                                ندارد
                            @endif
                        </td>
                        <td>
                            <div class="btn-group mr-2" role="group" aria-label="...">
                                <button type="submit" class="btn btn-info btn-sm btn-icon " data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Quiz">
                                    <a href="{{route('admin.quizzes.index',['course_id' => request('course_id') , 'part_id' => request('part_id') , 'lesson_id' => $lesson->id])}}">
                                        <i class="fa fa-scroll"></i></a>
                                </button>
                                <button class="deleteRecord btn btn-danger btn-sm btn-icon" data-id="{{ $lesson->id }}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="delete">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <!--end: DELETE-->
    <script type="text/javascript">

        $(".deleteRecord").click(function()
        {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            swal.fire({
                title: 'مطمئن هستید؟',
                text: "اطلاعات به طور کامل پاک خواهند شد.",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'نه،منصرف شدم!',
                reverseButtons: true
            }).then(function(result){
                if (result.value)
                {
                    $.ajax
                    ({
                        url: "/admin/lessons/"+id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function () {
                            swal.fire({
                                title: "حذف شد!",
                                text: "اطلاعات شما بطور کامل از بین رفت",
                                type: "success",
                                buttonsStyling: false,
                                confirmButtonText: "بسیارخب!",
                                confirmButtonClass: "btn btn-brand"
                            }).then(function (result) {
                                if(result.value){
                                    location.reload();
                                }
                            });
                        },
                        error: function () {
                            swal.fire({
                                title: "صفحه به درستی رفرش نشد!",
                                text: "لطفا اتصال اینترنت خود را بررسی کنید!",
                                type: "error",
                                buttonsStyling: false,
                                confirmButtonText: "بسیارخب!",
                                confirmButtonClass: "btn btn-brand"
                            });
                        }
                    });


                } else if (result.dismiss === 'cancel') {
                    swal.fire({
                        title: "منتفی شد!",
                        text: "هیچ موردی حذف نشد!",
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "بسیارخب!",
                        confirmButtonClass: "btn btn-brand"
                    });
                }
            });


        });
    </script>
    <!--end: DELETE-->

    <!--begin: DATATABLE-->
    <script src="/admin/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("#table_lessons").DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });
    </script>
    <!--end: DATATABLE-->


@endpush
