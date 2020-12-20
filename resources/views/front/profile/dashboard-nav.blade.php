<ul class="nav nav-pills my-1" id="post-bar" role="tablist">
    <li class="nav-item">
        <a class="nav-link mr-1 {{ request()->type == 'article' || request()->type == ''  ? 'active' : '' }}"
            href="{{ route('dashboard','article') }}">
                <span class="no-pm">My Article</span>
        </a>
        <a class="nav-link mr-1 {{ request()->type == 'review' ? 'active' : '' }}"
            href="{{ route('dashboard','review') }}">
                <span class="no-pm">My Review</span>
        </a>
    </li>
</ul>