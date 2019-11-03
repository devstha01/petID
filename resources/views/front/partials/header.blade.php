@php($route = Route::currentRouteName())

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-primary">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <span>PETiD</span>
            </a>
        </div>
        <div id="navbar-primary" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ $route == 'home'  ? 'active': null }}">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="{{ $route == 'return-found-pet'  ? 'active': null }}">
                    <a href="{{ url('/return-found-pet') }}">Pet Tag Lookup</a>
                </li>
                <li class="{{ $route == 'faq'  ? 'active': null }}">
                    <a href="{{ url('/faq') }}">FAQ</a>
                </li>
                 <li class="{{ $route == 'community'  ? 'active': null }}">
                    <a href="{{ url('/community') }}">Community</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">{{ currentUser()->first_name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @role('admin')
                                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endrole
                                @role('subscriber')
                                    <li><a href="{{ route('subscriber.contact-info') }}">Dashboard</a></li>
                                @endrole
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!--<li class="{{ $route == 'login'  ? 'current-page-item': null }}"><a href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="{{ $route == 'register'  ? 'current-page-item': null }}"><a
                                        href="{{ route('register') }}">Register</a></li>
                        @endif-->
                    @endauth
                @endif
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</nav>