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
                    <a href="{{route('admin.users')}}">
                            کاربران
                    </a>

                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="table_users" class="table table-bordered table-advance table-hover table-responsive-lg" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام </th>
                    <th>نام خانوادگی </th>
                    <th>ایمیل</th>
                    <th>سطح</th>
                    <th>تغییر سطح</th>
                    <th>شماره موبایل</th>
                    <th>جنسیت</th>
                    <th>ناریخ عضویت</th>

                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->is_admin == 1)
                                <span style="width: 133px;"><span class="kt-badge kt-badge--danger kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-danger">ادمین </span></span>
                            @else
                                <span style="width: 133px;"><span class="kt-badge kt-badge--success kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-success">کاربر عادی </span></span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_admin == 1)
                                <button class="changeAdmin btn btn-danger btn-sm btn-icon" data-id="{{ $user->id }}" data-level="{{$user->is_admin}}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="کاربر عادی شود">
                                    <i class="fa fa-power-off"></i>
                                </button>
                            @endif
                            @if($user->is_admin == 0)
                                <button class="changeAdmin btn btn-success btn-sm btn-icon" data-id="{{ $user->id }}" data-level="{{$user->is_admin}}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="ادمین  شود">
                                    <i class="fa fa-power-off"></i>
                                </button>
                            @endif
                        </td>
                        <td>{{$user->phone}}</td>
                        <td>
                            @if($user->gender == 1)
                                پسر
                            @else
                                دختر
                            @endif
                        </td>
                        <td>{{verta($user->created_at)->formatDate()}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')

    <!--begin: DATATABLE-->
    <script src="/admin/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("#table_users").DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });
    </script>
    <!--end: DATATABLE-->

    <!--begin: changeAdmin-->
    <script type="text/javascript">

        $(".changeAdmin").click(function()
        {
            var id = $(this).data("id");
            var level = $(this).data("level");
            var token = $("meta[name='csrf-token']").attr("content");
            swal.fire({
                title: 'مطمئن هستید؟',
                text: " سطح کاربر تغییرخواهد کرد!",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله تغییرکند!',
                cancelButtonText: 'نه،منصرف شدم!',
                reverseButtons: true
            }).then(function(result){
                if (result.value)
                {
                    $.ajax
                    ({
                        url: "/admin/users/" + id + "/" + level,
                        type: 'PUT',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function () {
                            swal.fire({
                                title: " سطح کاربر تغییرکرد!",
                                text: "وضعیت  آپدیت شد",
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
                        text: "وضعیت آپدیت نشد!",
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "بسیارخب!",
                        confirmButtonClass: "btn btn-brand"
                    });
                }
            });


        });
    </script>
    <!--end: changeAdmin-->
@endpush
