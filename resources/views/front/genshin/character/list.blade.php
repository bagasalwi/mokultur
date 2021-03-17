@foreach ($arr as $l)
    <a href="{{ url($path . '/' . $l . '/en.json') }}">{{ $l }}</a>
    <br>
@endforeach