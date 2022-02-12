@if (!$data->isEmpty())
@foreach ($data as $row)
@php
$last_id = $row->id;
@endphp

<div class="col-lg-12 col-sm-12">
    <a href="{{ route('post.detail',[$row->user->username,$row->id,$row->slug]) }}" class="card-block clearfix">
        <div class="card mb-4">
            <div class="card-body">
                @if ($row->photo() == "no-image")

                @else
                <div class="card-img-wrap">
                    <img class="img-fluid img-article" loading="lazy" src="{{ asset('storage/' . $row->photo()) }}"
                        alt="">
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
                        <h4 class="fw-600">{{ $row->title }}</h4>
                    </a>
                </div>
                <div id="counter" data-id="{{ $last_id }}"></div>
                <div class="text-secondary no-pm">
                    {{ str_limit(strip_tags($row->description),140,'...') }}
                </div>
                <div class="badges my-2">
                    @foreach ($row->tags as $tag)
                    <a href="{{ route('tag','tag='.$tag->slug) }}" class="badge badge-primary m-0">{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="card-footer d-flex flex-row align-items-center bd-highlight p-0 border-top">
                <a href="{{ route('creator.detail', $row->user->username) }}" class="foot-link border-right p-2 clearfix">
                    <span class="text-primary fw-600 mx-1">{{ '@'.$row->user->username }}</span>
                </a>
                <div class="foot-link border-right p-2">
                    <span class="text-secondary">
                        <small>
                            Terbit {{ Carbon\Carbon::parse($row->date_published)->diffForHumans() }} 
                        </small>
                    </span>
                </div>
                <a data-judul="{{ $row->title }}"
                    data-link="{{ route('post.detail',[$row->user->username,$row->id,$row->slug]) }}"
                    data-toggle="modal" data-target="#shareArticle" id="btn-share"
                    class="foot-link border-left p-2 ml-auto clearfix">
                    <span class="text-primary mx-1"><i class="fas fa-share-alt fa-sm"></i></span>
                </a>
                
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