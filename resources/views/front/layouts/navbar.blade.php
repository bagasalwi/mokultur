{{-- <nav class="navbar smart-scroll py-4 navbar-expand-lg navbar-light shadow">
    <div class="container">
        <a class="navbar-brand .d-block .d-sm-none" href="{{ url('/') }}">
<img src="{{ URL::asset('gambar/logo.png')}}" width="187" alt="">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item {{ ($title == "Home") ? "active" : "" }} align-self-center">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item {{ ($title == "KREASI") ? "active" : "" }} align-self-center">
            <a class="nav-link" href="{{ url('creation') }}">Kreasi</a>
        </li>
        <li class="nav-item {{ ($title == "KREATOR") ? "active" : "" }} align-self-center">
            <a class="nav-link" href="{{ url('creator') }}">Kreator</a>
        </li>
        <li class="nav-item {{ ($title == "Contact") ? "active" : "" }} align-self-center">
            <a class="nav-link" href="{{ url('contact') }}">Support</a>
        </li>
        <li class="nav-item border-left"></li>
        @guest
        <li class="nav-item align-self-center">
            <a class="nav-link" href="{{ url('login') }}">Masuk</a>
        </li>
        <li class="nav-item align-self-center">
            <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button">DAFTAR</a>
        </li>
        @else
        <li class="dropdown nav-item align-self-center">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                <img alt="image" width="30" height="30"
                    src="{{ URL::asset('gambar/profile_pic/' . Auth::user()->profile_pic) }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a href="{{ url('home') }}" class="dropdown-item has-icon">
                    Home
                </a>
                <a href="{{ url('profile') }}" class="dropdown-item has-icon">
                    My Profile
                </a>
                <a href="{{ url('post') }}" class="dropdown-item has-icon">
                    My Creation
                </a>
                @if (Auth::user()->hasRole('admin'))
                <a href="{{ url('admin/support') }}" class="dropdown-item has-icon">
                    Support
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>
</div>
</nav> --}}

{{-- <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fab fa-linkedin"></i><span class="d-lg-none ml-3">Linkedin</span>
    </a>
</li> --}}

<nav class="navbar smart-scroll navbar-expand-lg navbar-light shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ URL::asset('gambar/logo.png')}}" width="187" alt="">
        </a>

        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
            data-target="#navbar4">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar4">
            <ul class="navbar-nav mr-auto pl-lg-4">
                <li class="nav-item px-lg-2 {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">
                        <span class="d-inline-block d-lg-none icon-width">
                            <i class="fas fa-home"></i>
                        </span>Home
                    </a>
                </li>
                <li class="nav-item px-lg-2">
                    <a class="nav-link" href="#">
                        <span class="d-inline-block d-lg-none icon-width">
                            <i class="fas fa-spa"></i>
                        </span>Category
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-3 mt-lg-0">
                @guest
                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img alt="image" width="30" height="30"
                            src="{{ asset('gambar/profile_pic/default.png') }}"
                            class="rounded-circle mr-1">
                        <span class="d-lg-none ml-3"></span>
                    </a>
                    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </div>
                </li>
                @else
                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img alt="image" width="30" height="30"
                            src="{{ URL::asset('gambar/profile_pic/' . auth()->user()->profile_pic) }}"
                            class="rounded-circle mr-1">
                    </a>
                    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
                        <div class="dropdown-item">
                            <h6 class="p-0 m-0">
                                <span>{{ auth()->user()->name }}</span>
                            </h6>
                            <small class="p-0 m-0 text-muted">{{ auth()->user()->username }}</small>
                        </div>
                        <a class="dropdown-item has-icon" href="{{ url('profile') }}">
                            <span class="text-dark">Profile</span>
                        </a>
                        <a class="dropdown-item has-icon" href="{{ url('post') }}">
                            <span class="text-dark">My Post</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item has-icon" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-dark">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                {{-- <li class="nav-item">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Kreasi kesukaan mu!">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>