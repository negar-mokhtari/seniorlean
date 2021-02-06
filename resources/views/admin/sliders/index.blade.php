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
                    اسلاید ها
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('admin.sliders.create')}}" class="btn btn-label-brand " >
                    افزودن  اسلاید
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table id="table" class="table table-bordered table-advance table-hover table-responsive-lg">
                <thead>
                <tr>

                    <th>جابه جایی</th>
                    <th>الویت</th>
                    <th>موضوع</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody id="tablecontents">
                @foreach($sliders as $slider)
                    <tr class="row1" data-id="{{ $slider->id }}">
                        <td>
                            <i class="fa-lg fa fa-sort"  style="color:rgb(124,77,255);  cursor: pointer;"></i>
                        </td>
                        <td>{{$slider->priority}}</td>
                        <td>{{$slider->title}}</td>
                        <td>
                            <div class="btn-group mr-2" role="group" aria-label="...">
                                <button type="submit" class="btn btn-success btn-sm btn-icon " data-skin="dark" data-toggle="tooltip" data-placement="top" title="Show">
                                    <a href="#" class="showRecord" data-id="{{ $slider->id }}" data-image="{{$slider->image}}" data-title="{{$slider->title}}">
                                        <i class="la la-eye"></i></a>
                                </button>
                                <button class="deleteRecord btn btn-danger btn-sm btn-icon" data-id="{{ $slider->id }}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="delete">
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
    <!--begin: DELETE-->
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
                        url: "/admin/sliders/"+id,
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

    <!--begin: Modal for show image-->
    <script type="text/javascript">
        $(".showRecord").click(function(){
            var id = $(this).data("id");
            var image = $(this).data("image");
            var title = $(this).data("title");
            Swal.fire({
                title: title,
                // text: 'link: ',
                imageUrl: "http://seniorlearn.ir/storage/sliders/" + id + "/" + image,
                imageWidth: 400,
                imageHeight: 200,
                confirmButtonText: "بسیارخب!",
            })
        });
    </script>
    <!--end: Modal for show image-->

    <!--begin: Sortable and dataTable-->
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
    <script src="/admin/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>


    <script type="text/javascript">
        $(function () {
            $("#table").DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });

            $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    var priority = [];
                    $('tr.row1').each(function(index,element)
                    {
                        priority.push({
                            id: $(this).attr('data-id'),
                            position: index+1
                        });
                    });

                    $.ajax
                    ({
                        type: "POST",
                        // dataType: "json",
                        url: "{{route('admin.sliders.sortable')}}",
                        data: {
                            priority:priority,
                            _token: $("meta[name='csrf-token']").attr("content"),
                        },
                        success: function () {
                            swal.fire({
                                title: "آپدیت شد!",
                                text: "الویت ها با موفقیت تغییر کرد.",
                                type: "success",
                                buttonsStyling: false,
                                confirmButtonText: "بسیارخب!",
                                confirmButtonClass: "btn btn-brand"
                            }).then(function (result) {
                                location.reload();

                            });
                            // console.log(response);
                        },
                        error: function (response) {
                            swal.fire({
                                title: "صفحه به درستی رفرش نشد!",
                                text: "لطفا اتصال اینترنت خود را بررسی کنید!",
                                type: "error",
                                buttonsStyling: false,
                                confirmButtonText: "بسیارخب!",
                                confirmButtonClass: "btn btn-brand"
                            });
                            console.log(response);
                        }

                    });
                }
            });

        });

    </script>
    <!--end: Sortable and dataTable-->

@endpush
