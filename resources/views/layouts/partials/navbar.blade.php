<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Community Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home
                    </a>
                </li>

                @guest
                    <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                        <a class="nav-link btn-primary text-white" href="{{ route('register') }}">Sign up</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Route::input('id') == Auth::user()->id ? 'active' : '' }}"
                           href="{{ Auth::user()->getProfileUrl() }}">My profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'chats' ? 'active' : '' }}" href="{{ route('chats') }}">
                            Chats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-danger text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="clearfix my-5"></div>