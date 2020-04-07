<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">{{trans('user-management.title')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{ is_active_match('system/user') }}">
                            <a class="menu-item" href="{{'/system/user'}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.user')}}</a>
                        </li>
                        <li class="{{ is_active_match('user/role') }}">
                            <a class="menu-item" href="{{url('/user/role')}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.list_page_title')}}</a>
                        </li>
                        <li class="{{ is_active_match('user/permission') }}">
                            <a class="menu-item" href="{{'/user/permission'}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.permission_list_title')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endauth
    </div>
</div>
