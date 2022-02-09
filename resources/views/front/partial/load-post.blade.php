@if (!$data->isEmpty())
    @foreach ($data as $row)
    @php
        $last_id = $row->id;   
    @endphp    
    
    <div class="col-lg-12 col-sm-12">
        <a href="{{ route('post.detail',[$row->user->username,$row->id,$row->slug]) }}" class="card-block clearfix">
            <div class="card border-0 mb-4">
                    @if ($row->photo() == "no-image")
                
                    @else
                    <div class="card-img-wrap">
                        <img class="img-fluid img-article" loading="lazy" src="{{ asset('storage/' . $row->photo()) }}" alt="">
                    </div>
                    @endif

                    {{-- @if ($row->type == 'photo')
                    <div class="owl-carousel owl-theme slider container-mobile no-pm" id="carousel-post">
                        @foreach ($row->images()->get() as $image)
                        <img src="{{ asset('storage/' . $image->name) }}" class="img-fluid img-cover w-100">
                        @endforeach
                    </div>
                    @else
                        @if ($row->photo() == "no-image")

                        @else
                        <img src="{{ asset('storage/' . $row->photo()) }}" class="img-fluid mx-auto d-block img-article">
                    @endif
                    @endif --}}
                    
                {{-- @endif --}}
                <div class="mt-2">
                    <a href="{{ route('post.detail',[$row->user->username,$row->id,$row->slug]) }}" class="no-pm">
                        <h4 class="fw-700">{{ $row->title }}</h4>
                    </a>
                </div>
                <div id="counter" data-id="{{ $last_id }}"></div>
                <div class="text-secondary no-pm">
                    {{ str_limit(strip_tags($row->description),140,'...') }}
                </div>
                <div class="align-items-end mt-2">
                    <p class="text-secondary">
                        <small>
                            {{ Carbon\Carbon::parse($row->date_published)->diffForHumans() }} &middot; <a
                            href="{{ route('creator.detail', $row->user->username) }}">{{ '@'.$row->user->username }}</a>
                        </small>
                    </p>
                </div>
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


<script>
    $("#carousel-post").owlCarousel({
        items:1,
        // margin:10,
        autoHeight:true,
        nav: false,
        dots: true,
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
    });
</script>
