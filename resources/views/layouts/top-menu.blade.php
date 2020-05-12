<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills">

            @foreach ($sidebar as $sb)
            @if ($title == $sb->name)
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" href="{{ url($sb->url) }}">{{ $sb->name }}</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href="{{ url($sb->url) }}">{{ $sb->name }}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>