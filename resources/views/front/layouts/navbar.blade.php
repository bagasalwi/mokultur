<!-- Main Navbar Mobile -->
<b class="screen-overlay"></b>
<nav class="navbar2 navbar d-lg-none fixed-top navbar-expand-lg bg-black navbar-dark">
    <div class="container">
        <button data-trigger="#navbar_main" class="navbar-toggler pl-0" type="button"><span
                class="fas fa-bars text-white"></span></button>
        <a class="navbar-brand mx-auto py-2" href="{{ url('/') }}">
            <img src="{{ asset('gambar/logo/logo.png')}}" alt="">
            {{-- <h4 class="no-pm nav-link">MOKultur</h4> --}}
        </a>
    </div>
</nav>

<!-- Main Navbar -->
<nav id="navbar_main" class="mobile-offcanvas navbar navbar-dark navbar-transparent fixed-top navbar-expand-lg">
    <div class="container nav-cont">
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
            <img src="{{ asset('gambar/logo/logo.png')}}" alt="">
        </a>
        <div class="offcanvas-header">
            <button class="navbar-toggler btn-close"><span class="fas fa-bars"></span></button>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('browse') || request()->is('browse/*') ? 'font-weight-bold' : '' }}"
                    href="{{ route('browse') }}">Browse</a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('topic') ? 'font-weight-bold' : '' }}"
                    href="{{ route('topic') }}">Topics</a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('creator') ? 'font-weight-bold' : '' }}"
                    href="{{ route('creator') }}">Creators</a>
            </li>
            @guest
            <li class="nav-item py-2 dropdown">
                <a class="nav-link font-tokyo text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="no-pm">Account <i class="fas fa-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('login') }}">Login</a>
                    {{-- <a class="dropdown-item" href="{{ url('register') }}">Register</a> --}}
                </div>
            </li>
            @else

            @php
            $fullname = auth()->user()->name;
            $fullname = trim($fullname); // remove double space
            $firstname = substr($fullname, 0, strpos($fullname, ' '));
            $lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
            @endphp
            <li class="nav-item py-2 dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="no-pm">{{ Str::upper(auth()->user()->username) }} <i
                            class="fas fa-chevron-down"></i></span>
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