<b class="screen-overlay"></b>
<nav class="navbar2 navbar d-lg-none fixed-top navbar-expand-lg navbar-light">
    <div class="container">
        <button data-trigger="#navbar_main" class="navbar-toggler" type="button"><span
                class="fas fa-bars"></span></button>
        <a class="navbar-brand mx-auto" href="{{ url('/') }}">
            <img src="{{ asset('gambar/logo/gweekly-logo.png')}}" alt="">
        </a>
    </div>
</nav>

<!-- d-lg-none -->

<nav id="navbar_main" class="mobile-offcanvas navbar fixed-top navbar-expand-lg shadow-sm">
    <div class="container nav-cont">
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
            <img src="{{ asset('gambar/logo/gweekly-logo.png')}}" alt="">
        </a>
        <div class="offcanvas-header">
            <button class="navbar-toggler btn-close"><span class="fas fa-bars"></span></button>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item {{ request()->is('browse') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('browse') }}">
                    BROWSE
                </a>
            </li>
            <li class="nav-item {{ request()->is('topic') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('topic') }}">
                    TOPICS
                </a>
            </li>
            <li class="nav-item {{ request()->is('creator') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('creator') }}">
                    CREATORS
                </a>
            </li>
            {{-- <li class="nav-item {{ request()->is('event') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('topic.event') }}">
                    EVENT
                </a>
            </li> --}}
            @guest
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    MY ACCOUNT
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('login') }}">Login</a>
                    <a class="dropdown-item" href="{{ url('register') }}">Register</a>
                </div>
            </li>
            @else

            @php
            $fullname = auth()->user()->name;
            $fullname = trim($fullname); // remove double space
            $firstname = substr($fullname, 0, strpos($fullname, ' '));
            $lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    {{ strlen($firstname) > 20 ? substr($firstname, 0, 20) . '...' : $firstname }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item d-flex flex-row" href="#">
                        <img alt="image" width="30" height="30"
                            src="{{ asset('storage/' . auth()->user()->profile_pic) }}" class="rounded-circle no-pm">
                        <div class="ml-2">
                            <h6 class="p-0 m-0">
                                {{ strlen($fullname) > 20 ? substr($fullname, 0, 20) . '...' : $fullname }}
                            </h6>
                            <small class="p-0 m-0 text-muted">{{ auth()->user()->username }}</small>
                        </div>
                    </a>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('post') }}">
                        My Post
                    </a>
                    @if (auth()->user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ url('admin') }}">
                        Admin Menu
                    </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>

</nav>