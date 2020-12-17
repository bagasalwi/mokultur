<ul class="nav nav-pills my-1" id="post-bar" role="tablist">
    <li class="nav-item">
        <a class="nav-link mr-1 {{ request()->type == 'article' || request()->type == ''  ? 'active' : '' }}"
            href="{{ route('dashboard','article') }}">
            <div>
                <span class="no-pm">My Article</span>
            </div>
        </a>
        <a class="nav-link mr-1 {{ request()->type == 'review' ? 'active' : '' }}"
            href="{{ route('dashboard','review') }}">
            <div>
                <span class="no-pm">My Review</span>
            </div>
        </a>
    </li>
</ul>