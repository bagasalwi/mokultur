<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Kreasi Bangsa</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">KB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">My Profile</li>
            <li>
                <a class="nav-link active" href="{{ url('/') }}">
                    <i class="fas fa-archway"></i>
                    <span>Website</span>
                </a>
            </li>

            <li class="menu-header">Menu</li>
            @foreach ($sidebar as $sb)

            @if ($title == $sb->name)
            <li class="active">
                @else
            <li>
                @endif
                <a class="nav-link active" href="{{ url($sb->url) }}">
                    <i class="{{ $sb->icon }}"></i>
                    <span>{{ $sb->name }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
</div>