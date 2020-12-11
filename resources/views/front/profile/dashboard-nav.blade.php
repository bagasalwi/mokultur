<ul class="nav nav-pills my-1" id="post-bar" role="tablist">
    <li class="nav-item">
        <a class="nav-link mr-1 {{ request()->type == 'article' || request()->type == ''  ? 'active' : '' }}"
            href="{{ route('dashboard','article') }}">
            <div class="p-1">
                <h6 class="no-pm">My Article</h6>
            </div>
        </a>
        <a class="nav-link mr-1 {{ request()->type == 'review' ? 'active' : '' }}"
            href="{{ route('dashboard','review') }}">
            <div class="p-1">
                <h6 class="no-pm">My Review</h6>
            </div>
        </a>
    </li>
</ul>