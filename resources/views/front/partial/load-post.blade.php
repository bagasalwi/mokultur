@if (!$data->isEmpty())
    @foreach ($data as $row)
    @php
        $last_id = $row->id;   
    @endphp    
    
    <div class="col-lg-12 col-sm-12">
        <a href="{{ route('post.detail',[$row->user->username,$row->slug]) }}" class="card-block clearfix">
            <div class="card border-0 mb-4">
                {{-- @if ($row->type == 'photo')
                <div class="owl-carousel owl-theme slider" id="carousel-post">
                    @foreach ($row->images()->get() as $image)
                    <img src="{{ asset('storage/' . $image->name) }}" class="img-fluid img-cover w-100 bd-radius-4">
                    @endforeach
                </div>
                @else --}}
                    @if ($row->photo() == "no-image")
                
                    @else
                    <div class="card-img-wrap bd-radius-4">
                        <img class="img-fluid img-article" loading="lazy" src="{{ asset('storage/' . $row->photo()) }}" alt="">
                    </div>
                    @endif
                {{-- @endif --}}
                <div class="mt-2">
                    <a href="{{ route('post.detail',[$row->user->username,$row->slug]) }}" class="no-pm">
                        <h4 class="fw-700">{{ $row->title }}</h4>
                    </a>
                </div>
                <div id="counter" data-id="{{ $last_id }}"></div>
                <small class="text-secondary">
                    {!! \Carbon\Carbon::parse($row->date_published)->format('d M Y') . '<span class="font-weight-bold mx-1">&#183;</span>' . $row->user->name !!}
                </small>
            </div>
        </a>
    </div>
    @endforeach
    <div id="load_more" class="col-12 mt-4 text-center">
        <button id="loadpost" class="btn btn-block btn-dark" data-id="{{ $last_id }}">
            Jangkau Lebih Jauh
        </button>
    </div>
@else
    <div id="load_more" class="col-12 mt-4 text-center">
        <h6 class="text-secondary">Selamat, Kamu sudah meng-kulturi semua artikel!</h6>
    </div>
@endif
