<nav id="navbar_top" class="navbar py-4 navbar-expand-lg navbar-light shadow">
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
</nav>