<ul class="nav nav-pills" id="post-bar" role="tablist">
    <li class="nav-item">
        <a class="nav-link mr-1 {{ request()->type == 'article' || request()->type == ''  ? 'active' : '' }}"
            href="{{ route('creator.detail',[$user->username,'article']) }}">
            <div class="p-1">
                <h6 class="no-pm">{{ $firstname }} Article</h6>
            </div>
        </a>
        <a class="nav-link mr-1 {{ request()->type == 'review' ? 'active' : '' }}"
            href="{{ route('creator.detail',[$user->username,'review']) }}">
            <div class="p-1">
                <h6 class="no-pm">{{ $firstname }} Review</h6>
            </div>
        </a>
    </li>
</ul>