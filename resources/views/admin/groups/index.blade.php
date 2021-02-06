@extends('admin.layout.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/custom/datatables/datatables.bundle.rtl.css"/>
@endpush

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    <a href="{{route('admin.groups.index')}}">
                         گروه بندی فلش کارت ها
                    </a>
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a data-toggle="modal" data-target="#modal_create_group" class="btn btn-label-brand " >افزودن  گروه
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="table_groups"  class="table table-bordered table-advance table-hover table-responsive-lg">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>{{$group->name}}</td>
                        <td>
                            <div class="btn-group mr-2" role="group" aria-label="...">
                                <button type="submit" class="btn btn-primary btn-sm btn-icon " data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Flash Cards">
                                    <a href="{{route('admin.cards.index',['group_id' => $group->id])}}">
                                        <i class="la la-folder-open-o"></i></a>
                                </button>
                                <button class="deleteRecord btn btn-danger btn-sm btn-icon" data-id="{{ $group->id }}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="delete">
                                    <i class="fa fa-trash-alt"></i>
                                </button>

                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
            <div class="modal fade" id="modal_create_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">افزودن گروه برای فلش کارت ها </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('admin.groups.store')}}" class="kt-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">نام </label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="form-group" id="columns">
                                    <label>درج ستون های جدول به تعداد دلخواه</label>
                                    <div data-repeater-list="columns">
                                        <div data-repeater-item class="row align-items-center kt-margin-b-10">
                                            <div class="col-lg-5">
                                                <input type="text" name="name" class="form-control" placeholder="عنوان ستون جدول">
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-label-danger">
                                                    <i class="la la-minus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;" data-repeater-create="" class="btn btn-sm btn-icon btn-default btn-icon-md">
                                        <i class="la la-plus"></i>
                                    </a>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <button type="submit" class="btn btn-success">ثبت اطلاعات</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <script>
        jQuery(document).ready(function () {
            var repeaterOptions = {
                initEmpty: false,
                isFirstItemUndeletable: true,
            };

            $('#columns').repeater(repeaterOptions);
            $('.kt-form').validate({
                rules: {
                    fa_group_name: {
                        required: true,
                        maxlength: 64,
                        minlength: 3,
                    },
                    en_group_name: {
                        required: true,
                        maxlength: 64,
                        minlength: 3,
                    },
                },
            });
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
                            url: "/admin/groups/"+id,
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
        });


    </script>
    <!--begin: DATATABLE-->
    <script src="/admin/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("#table_groups").DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });
    </script>
    <!--end: DATATABLE-->
@endpush
