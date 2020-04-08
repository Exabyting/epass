<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ is_active_route('hrm') }}">
                <a href="{{ route('hrm') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:;"><i class="la la-cogs"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.settings')</span>
                </a>
                <ul class="menu-content">
                    @if(auth()->user()->can('hrm-setting-access') || auth()->user()->can('system-super-admin'))
                        <li class="{{ is_active_match('hrm/employee') }}">
                            <a href="{{ url('hrm/employee') }}">
                                <i class="la la-users"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::employee.menu_name')</span>
                            </a>
                        </li>
                        <li class="{{ is_active_match('hrm/department')}}">
                            <a href="{{ url('hrm/department') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::department.left_menu_title')</span>
                            </a>
                        </li>
                        <li class="{{ is_active_match('hrm/sections')}}">
                            <a href="{{ url('hrm/sections') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::department.section_title')</span>
                            </a>
                        </li>
                        <li class="{{ is_active_match('hrm/designation') }}">
                            <a href="{{ url('hrm/designation') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::designation.left_menu_title')</span>
                            </a>
                        </li>
                        <li class="{{ is_active_route('employee-officer.create') }}">
                            <a href="{{route('employee-officer.create')}}">
                                <i class="la la-gg-circle"></i>

                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::employee.employee_officer')</span>
                            </a>
                        </li>
                    @endif
                    <li class="{{ is_active_match('/change/password') }}">
                        <a href="{{url('/change/password')}}">
                            <i class="la la-key"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('labels.change_password')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/lang/'. get_localization_config()->key)}}">
                            <i class="la la-flag-o"></i><strong>ভাষা {{ get_localization_config()->value }} এ
                                পরিবর্তন</strong>
                        </a>
                    </li>
                    @can('system-super-admin')
                    <!-- System User -->
                        {{--                        <li class=" nav-item">--}}
                        {{--                            <a href="javascript:;"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">@lang('user-management.title')</span></a>--}}
                        {{--                            <ul class="menu-content">--}}
                        <li class="{{ is_active_match('system/user') }}">
                            <a class="menu-item" href="{{'/system/user'}}" data-i18n="nav.users.user_profile"><i
                                    class="la la-users"></i>{{trans('labels.user')}}</a>
                        </li>
                        <li class="{{ is_active_match('system-settings') }}">
                            <a class="menu-item" href="{{route('system-settings.index')}}"
                               data-i18n="nav.users.user_profile">
                                <i class="la la-cogs"></i>{{trans('settings.system_settings')}}</a>
                        </li>
                        {{--                                <li class="{{ is_active_match('user/role') }}">--}}
                        {{--                                    <a class="menu-item" href="{{url('/user/role')}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.list_page_title')}}</a>--}}
                        {{--                                </li>--}}
                        {{--                    <li class="{{ is_active_match('user/permission') }}">--}}
                        {{--                        <a class="menu-item" href="{{'/user/permission'}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.permission_list_title')}}</a>--}}
                        {{--                    </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}
                    <!-- // System User -->
                    @endcan
                    @can('site-admin')
                        <li class="{{ is_active_match('system-config') }}">
                            <a class="menu-item" href="{{route('system-config.index')}}"
                               data-i18n="nav.users.user_profile"><i
                                    class="la la-cog"></i>{{trans('settings.system-config')}}</a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>
