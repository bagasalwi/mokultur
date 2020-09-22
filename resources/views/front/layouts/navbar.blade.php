<nav class="navbar smart-scroll navbar-expand-lg navbar-light shadow-sm fixed-top">
    <div class="container" id="navbar-container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ URL::asset('gambar/logo.png')}}" width="100" alt="">
        </a>

        <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
            data-target="#navbar4">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar4">
            <ul class="navbar-nav mr-auto pl-lg-4">
                <li class="nav-item px-lg-2 {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">
                        HOME
                    </a>
                </li>
                <li class="nav-item px-lg-2 {{ request()->is('topic') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('topic') }}">
                        CATEGORY
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-3 mt-lg-0">
                <li class="nav-item">
                    <button type="button" id="searchBtn" class="btn btn-default navbar-btn"><i
                            class="fa fa-search"></i></button>
                </li>
                <form id="searchForm" action="{{ url('search') }}" role="search" style="display:none">
                    <input type="text" class="form-control-sm form-control" placeholder="Search">
                </form>
                @guest
                <li class="nav-item px-lg-2 dropdown d-menu">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img alt="image" width="30" height="30" src="{{ asset('gambar/profile_pic/default.png') }}"
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
                        <a class="dropdown-item">
                            <h6 class="p-0 m-0">
                                <span
                                    class="font-weight-normal">{{ strlen(auth()->user()->name) > 50 ? substr(auth()->user()->name, 0, 18) . '...' : auth()->user()->name }}</span>
                            </h6>
                            <small class="p-0 m-0 text-muted">{{ auth()->user()->username }}</small>
                        </a>
                        <a class="dropdown-item has-icon" href="{{ url('profile') }}">
                            <span class="text-dark">Profile</span>
                        </a>
                        <a class="dropdown-item has-icon" href="{{ url('post') }}">
                            <span class="text-dark">My Post</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item has-icon"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">
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