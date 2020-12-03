<ul class="nav nav-pills my-1" id="post-bar" role="tablist">
    <li class="nav-item">
        <a class="nav-link mr-1 {{ request()->type == 'article' || request()->type == ''  ? 'active' : '' }}"
            href="{{ route('creator.detail',[$user->username,'article']) }}">{{ $firstname }} Article</a>
        <a class="nav-link mr-1 {{ request()->type == 'review' ? 'active' : '' }}"
            href="{{ route('creator.detail',[$user->username,'review']) }}">{{ $firstname }} Review</a>
    </li>
</ul>