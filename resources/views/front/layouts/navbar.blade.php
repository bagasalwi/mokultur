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
                <li class="nav-item px-lg-2 active">
                    <a class="nav-link" href="#">
                        <span class="d-inline-block d-lg-none icon-width">
                            <i class="fas fa-home"></i>
                        </span>Home
                    </a>
                </li>
                <li class="nav-item px-lg-2"> <a class="nav-link" href="#">
                        <span class="d-inline-block d-lg-none icon-width"><i class="fas fa-spa"></i>
                        </span>Services</a>
                </li>
                <li class="nav-item px-lg-2"> <a class="nav-link" href="#"><span
                            class="d-inline-block d-lg-none icon-width">
                            <i class="far fa-user"></i>
                        </span>About</a>
                </li>

                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><span class="d-inline-block d-lg-none icon-width"><i
                                class="far fa-caret-square-down"></i></span>Dropdown
                        <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                    <div class="dropdown-menu shadow-sm sm-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>

                <li class="nav-item px-lg-2"> <a class="nav-link" href="#"><span
                            class="d-inline-block d-lg-none icon-width"><i
                                class="far fa-envelope"></i></span>Contact</a> </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-3 mt-lg-0">
                <li class="nav-item"> <a class="nav-link" href="#">
                        <i class="fab fa-twitter"></i><span class="d-lg-none ml-3">Twitter</span>
                    </a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">
                        <i class="fab fa-facebook"></i><span class="d-lg-none ml-3">Facebook</span>
                    </a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">
                        <i class="fab fa-instagram"></i><span class="d-lg-none ml-3">Instagram</span>
                    </a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">
                        <i class="fab fa-linkedin"></i><span class="d-lg-none ml-3">Linkedin</span>
                    </a> </li>
            </ul>
        </div>
    </div>
</nav>