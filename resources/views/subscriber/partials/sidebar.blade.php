@php($route = Route::currentRouteName())
<nav class="nav-subscriber-dashboard">
    <div class="nav-header">
        <span>Menu</span>
        <a href="javascript:void(0);" id="nav-toggle" class="nav-toggle">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <ul class="nav nav-pills nav-stacked">
        {{--<li class="{{ $route == 'subscriber.dashboard'  ? 'active': null }}">--}}
            {{--<a href="{{ route('subscriber.dashboard') }}">Dashboard</a>--}}
        {{--</li>--}}
        <li class="{{ $route == 'subscriber.account'  ? 'active': null }}">
            <a href="{{ route('subscriber.account') }}"><i class="fa fa-user"></i>My Account</a>
        </li>
        <li class="{{ $route == 'subscriber.contact-info'  ? 'active': null }}">
            <a href="{{ route('subscriber.contact-info') }}"><i class="fa fa-address-card"></i>Recovery Info</a>
        </li>
        <li class="{{ $route == 'subscriber.lockscreen'  ? 'active': null }}">
            <a href="{{ route('subscriber.lockscreen') }}"><i class="fa fa-image"></i>My Lockscreen</a>
        </li>
        <li class="{{ $route == 'subscriber.subscription'  ? 'active': null }}">
            <a href="{{ route('subscriber.subscription') }}"><i class="fa fa-credit-card"></i>My Subscription</a>
        </li>
        <li class="{{ $route == 'subscriber.account.change-password'  ? 'active': null }}">
            <a href="{{ route('subscriber.account.change-password') }}"><i class="fa fa-key"></i>Change Password</a>
        </li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Logout</a>
        </li>
    </ul>
</nav>