{{-- {{ dd($list) }} --}}
@foreach ($list as $key => $item)
    {{-- {{ dd($item) }} --}}
    <p><img src="{{ $item->icon }}" width="25" height="25" alt=""></p>
    <p><img src="{{ $item->portrait }}" width="50" height="50" alt=""></p>
    <p><a href="{{ url('genshin/characters/' . $item->name) }}">{{ $item->name }}</a></p>
    <hr>
@endforeach
