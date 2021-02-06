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
                    <a href="{{route('admin.groups.index')}}">
                        دسته بندی فلش کارت ها:
                    </a>
                    {{\App\Models\Group::all()->where('id',request('group_id'))->pluck('name')[0]}}
                    <i class="fa fa-angle-double-left"></i>
                    <a href="{{route('admin.cards.index',['group_id' => request('group_id')])}}">
                        فلش کارت ها
                    </a>
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.cards.create',['group_id' => request('group_id')])}}" class="btn btn-label-brand " >
                    افزودن  فلش کارت
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="table_cards" class="table table-bordered table-advance table-hover table-responsive-lg" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>تلفظ</th>
                    @foreach(array($group->columns)[0] as $item)
                        <th>{{$item['name']}}</th>
                    @endforeach
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <td>{{$card->id}}</td>
                        <td>
                            @if($card->name != null)
                                دارد
                            @else
                                ندارد
                            @endif
                        </td>
                        <td>
                            @if($card->voice != null)
                                دارد
                            @else
                                ندارد
                            @endif
                        </td>
                        <td>
                            @if($card->image != null)
                                دارد
                            @else
                                ندارد
                            @endif
                        </td>
                        @foreach(\App\Models\Card::where('id',$card->id)->first()->details as $detail)
                            <td>
                                {{$detail}}
                            </td>
                        @endforeach
                        <td>
                            <div class="btn-group mr-2" role="group" aria-label="...">
                                <button class="deleteRecord btn btn-danger btn-sm btn-icon" data-id="{{ $card->id }}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="delete">
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
                            url: "/admin/cards/"+id,
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
            $("#table_cards").DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });
    </script>
    <!--end: DATATABLE-->
@endpush
