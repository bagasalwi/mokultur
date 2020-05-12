<nav class="navbar py-4 navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand .d-block .d-sm-none" href="#">
            <img src="{{ URL::asset('gambar/logo.png')}}" width="187" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-right ml-auto">
                <li class="nav-item {{ ($title == "Home") ? "active" : "" }} align-self-center">
                    <a class="nav-link" href="{{ url('/') }}">HOME</a>
                </li>
                <li class="nav-item {{ ($title == "KREASI") ? "active" : "" }} align-self-center">
                    <a class="nav-link" href="{{ url('creation') }}">KREASI</a>
                </li>
                <li class="nav-item {{ ($title == "KREATOR") ? "active" : "" }} align-self-center">
                    <a class="nav-link" href="{{ url('creator') }}">KREATOR</a>
                </li>
                <li class="nav-item {{ ($title == "Contact") ? "active" : "" }} align-self-center">
                    <a class="nav-link" href="{{ url('contact') }}">CONTACT</a>
                </li>
                @guest
                <a class="btn px-4 btn-primary ml-4" href="{{ route('login') }}" role="button">MASUK</a>
                <a class="btn px-4 btn-outline-primary ml-2" href="{{ route('register') }}" role="button">DAFTAR</a>
                @else
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                        <img alt="image" width="30" height="30"
                            src="{{ URL::asset('gambar/profile_pic/' . Auth::user()->profile_pic) }}"
                            class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged
                            {{ \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() }}</div>
                        <a href="{{ url('home') }}" class="dropdown-item has-icon {{ ($title == "Home") ? "active" : "" }}">
                            Home
                        </a>
                        <a href="{{ url('profile') }}" class="dropdown-item has-icon {{ ($title == "My Profile") ? "active" : "" }}">
                            My Profile
                        </a>
                        <a href="{{ url('post') }}" class="dropdown-item has-icon {{ ($title == "My Post") ? "active" : "" }}">
                            My Creation
                          </a>
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