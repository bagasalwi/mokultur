<div class="navigation-wrap bg-light start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">
                
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ URL::asset('gambar/logo.png')}}" alt="">
                    </a>	
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto py-4 py-md-0">
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ request()->is('browse') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('browse') }}">
                                    <h6 class="no-pm">BROWSE</h6>
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ request()->is('topic') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('topic') }}">
                                    <h6 class="no-pm">TOPICS</h6>
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ request()->is('creator') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('creator') }}">
                                    <h6 class="no-pm">CREATORS</h6>
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ request()->is('event') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('topic.event') }}">
                                    <h6 class="no-pm">EVENT</h6>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            @guest
                            <li class="nav-item dropdown pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="no-pm">MY ACCOUNT<i class="fas fa-caret-down ml-2"></i></h6>
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
                            <li class="nav-item dropdown pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="no-pm">{{ strlen($firstname) > 20 ? substr($firstname, 0, 20) . '...' : $firstname }}<i class="fas fa-caret-down ml-2"></i></h6>
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
            </div>
        </div>
    </div>
</div>