<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  {{request()->is('admin/dashboard') ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.dashboard')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">پیشخوان</span></a></li>
                <li class="kt-menu__item  {{request()->is(['admin/courses*','admin/parts*','admin/lessons*','admin/quizzes*','admin/questions*']) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.courses.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-squares-1"></i><span class="kt-menu__link-text">دوره ها</span></a></li>
                <li class="kt-menu__item {{request()->is('admin/users*') ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.users')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-users-1"></i><span class="kt-menu__link-text">کاربران</span></a></li>

                <li class="kt-menu__item {{request()->is(['admin/categories*','admin/contents*']) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.categories.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-crisp-icons"></i><span class="kt-menu__link-text">مدیریت محتوا</span></a></li>
                <li class="kt-menu__item {{request()->is(['admin/groups*','admin/cards*']) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.groups.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-list-1"></i><span class="kt-menu__link-text">مدیریت فلش کارت </span></a></li>
                <li class="kt-menu__item {{request()->is('admin/sliders*') ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{route('admin.sliders.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-laptop"></i><span class="kt-menu__link-text">اسلایدرها</span></a></li>
{{--                <li class="kt-menu__item {{request()->is('comments*' ? 'kt-menu__item--active' : '')}}"  aria-haspopup="true"><a href="{{route('comments.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-comments"></i><span class="kt-menu__link-text">مدیریت نظرات</span></a></li>--}}
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="kt-menu__link ">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <i class="kt-menu__link-icon flaticon-logout"></i><span class="kt-menu__link-text">خروج</span>


                    </a>
                </li>

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
