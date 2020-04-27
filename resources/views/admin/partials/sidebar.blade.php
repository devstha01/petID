@php($route = Route::currentRouteName())
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>

<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav ">
            <li class="m-menu__item{{ $route == 'admin.dashboard'  ? ' m-menu__item--active': null }}" aria-haspopup="true">
                <a href="{{ route('admin.dashboard') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-text">Dashboard</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item--submenu{{ $route == 'admin.subscribers.index' || $route == 'admin.subscribers.create' || $route == 'admin.subscribers.edit'  ? ' m-menu__item--active m-menu__item--open': null }}"
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Subscribers</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__item-here"></span>
                                <span class="m-menu__link-text">Subscribers</span>
                            </span>
                        </li>
                        <li class="m-menu__item{{ $route == 'admin.subscribers.index'  ? ' m-menu__item--active': null }}"
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('admin.subscribers.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">All Subscribers</span>
                            </a>
                        </li>
                        <li class="m-menu__item{{ $route == 'admin.no-tags-purchased-users'  ? ' m-menu__item--active': null }}"
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('admin.no-tags-purchased-users') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">No Tags User</span>
                            </a>
                        </li>
                        <li class="m-menu__item{{ $route == 'admin.subscribers.create'  ? ' m-menu__item--active': null }}"
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('admin.subscribers.create') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item{{ $route == 'admin.orders.download.template'  ? ' m-menu__item--active': null }}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('admin.orders.download.template') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-coins"></i>
                    <span class="m-menu__link-text">Download Templates</span>
                </a>
            </li>

            {{-- <li class="m-menu__item{{ $route == 'admin.transactions.index'  ? ' m-menu__item--active': null }}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('admin.transactions.index') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-coins"></i>
                    <span class="m-menu__link-text">Transactions</span>
                </a>
            </li> --}}
             <li class="m-menu__item{{ $route == 'admin.orders.index'  ? ' m-menu__item--active': null }}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('admin.orders.index') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-coins"></i>
                    <span class="m-menu__link-text">Order Tags</span>
                </a>
            </li>

            <li class="m-menu__item{{ $route == 'admin.influencer.index'  ? ' m-menu__item--active': null }}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('admin.influencer.index') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon"><i class="fa fa-user-circle"></i></i>
                    <span class="m-menu__link-text">Influencer</span>
                </a>
            </li>

            <li class="m-menu__item{{ $route == 'admin.discount.index'  ? ' m-menu__item--active': null }}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('admin.discount.index') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon"><i class="fa fa-user-circle"></i></i>
                    <span class="m-menu__link-text">Discount Codes</span>
                </a>
            </li>

            <!--<li class="m-menu__item" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="#" class="m-menu__link">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-settings"></i>
                    <span class="m-menu__link-text">Settings</span>
                </a>
            </li>-->
            <li class="m-menu__item" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="#" class="m-menu__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-logout"></i>
                    <span class="m-menu__link-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->