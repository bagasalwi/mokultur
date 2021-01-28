@extends('front.layouts.master')

@section('meta_title'){{ $post->title }}@endsection
@section('meta_keyword'){{ implode(', ', $meta_tags) }}@endsection
@section('meta_desc'){{ str_limit(strip_tags($post->description),180,'...') }}@endsection
@section('meta-tags')
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ str_limit(strip_tags($post->description),180,'...') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="og:image" content="{{ asset('storage/' . $post->photo()) }}" />
@endsection

@section('content')

<div class="jumbotron jumbotron-fluid mb-0" data-background-topic="{{ asset('storage/' . $post->category->banner) }}">
    <div class="jumbotron-overlay"></div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2 text-center">
                <h2 class="text-white fw-700">{{ $post->category->name }}</h2>
                <span class="text-white">{{ $post->category->description }}</span>
            </div>
        </div>
    </div>
</div>

<section class="mini-section">
    <div class="container mt-2">
        <div class="row">
            @include('front.partial.left-bar')
            <div class="col-md-6 col-sm-12">
                <h4>
                    @if ($post->checkStatus() == 'DRAFT')
                        <span class="badge badge-danger px-4">{{ $post->checkStatus() }}</span>
                    @endif
                </h4>
                <h1 class="text-dark fw-700 mb-4">{{ $post->title }}</h1>
                <div class="row my-3">
                    <div class="col-6 d-flex flex-row">
                        <div class="align-self-center mr-2">
                            <img alt="image" width="50" height="50"
                                src="{{ asset('storage/' . $post->user->profile_pic) }}"
                                class="rounded-circle">
                        </div>
                        <div class="align-self-center">
                            <h6 class="no-pm">
                                <a class="text-dark"
                                    href="{{ route('creator.detail', $post->user->username) }}">{{ $post->user->name }}</a>
                            </h6>
                            <p class="no-pm"><small class="text-secondary">{{ $estimated_time }} read</small></p>
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-row-reverse">
                        <div class="align-self-end">
                            @if ($post->date_published != null)
                            <p class="p-0 m-0"><small class="text-dark">Published
                                {{ Carbon\Carbon::parse($post->date_published)->format('d-M-Y') }}</small></p>
                            @else
                            <p class="p-0 m-0"><small class="text-dark">Published
                                {{ $post->created_at->format('d-M-Y') }}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($post->type == 'photo')
                <div class="owl-carousel owl-theme slider" id="carousel-post">
                    @foreach ($post->images()->get() as $image)
                        <img src="{{ asset('storage/' . $image->name) }}" class="img-fluid img-cover w-100 bd-radius-4">
                    @endforeach
                </div>
                @else
                    @if ($post->photo() == "no-image")
                    
                    @else
                    <img src="{{ asset('storage/' . $post->photo()) }}" class="img-fluid mx-auto d-block img-article bd-radius-4">
                    @endif
                @endif
                <div id="posting" class="content my-4">
                    {!! $post->description !!}
                </div>

                <hr>
                <div class="badges my-4">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tag','tag='.$tag->slug) }}" class="badge badge-primary">{{$tag->name}}</a>
                    @endforeach
                </div>

                <hr>

                <a href="{{ route('post.detail',[$selanjutnya->user->username,$selanjutnya->slug]) }}" class="clearfix">
                    <div class="card card-hover bd-radius-4 shadow py-2 px-2 my-4">
                        <div class="row align-items-center">
                            <div class="col-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid img-article bd-radius-4" loading="lazy" src="{{ asset('storage/' . $selanjutnya->photo()) }}" alt="">
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-md-8 ml-0 pl-0">
                                <span class="badge badge-info">BACA SELANJUTNYA</span>
                                <div class="my-1">
                                    <h6 class="no-pm">{{ $selanjutnya->title }}</h6>
                                </div>
                                <div class="d-none d-lg-block">
                                    <div class="text-secondary text-small no-pm ">{{ str_limit(strip_tags($selanjutnya->description),100,'...') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="mt-2" id="disqus_thread"></div>

                @if ($recomendation->isNotEmpty())
                <div class="heading2">
                    <h5 class="mt-4 fw-700">Topik <span class="text-primary">Rekomendasi</span></h5>    
                </div>
                <div class="row">
                    @foreach ($recomendation as $p)
                    <div class="col-md-6 col-lg-6 mb-4">
                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border my-2 shadow bd-radius-4">
                                <div class="card-img-top">
                                    <div class="card-img-wrap bd-radius-4">
                                        <img class="img-fluid img-article" loading="lazy" src="{{ asset('storage/' . $p->photo()) }}"
                                            alt="">
                                        {{-- <div class="card-img-overlay text-white">
                                            <h4 class="badge badge-primary shadow">{{ $p->category->name }}</h4>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mt-2">
                                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="no-pm">
                                            <h6>{{ $p->title }}</h6>
                                        </a>
                                    </div>
                                    <small class="text-secondary">
                                        {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                        {{ $p->user->name }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</section>

@endsection

@section('script')
<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec27a5c1fa87300122c9912&product=inline-share-buttons&cms=website'
    async='async'></script>

<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://kreasibangsa.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<script>
    $(document).ready(function(){
        $('#posting img').addClass('img-fluid');
    });

    $("#carousel-post").owlCarousel({
        items:1,
        // margin:10,
        autoHeight:true,
        nav: true,
        dots: false,
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
    });

    // var filter = ['tai','laravel'];
    // $.get("{{ asset('wordlist/badword.list') }}", function(data){
    //     var filter = data.split('\n');
    // });

    // console.log(filter[0],filter[1],filter[2])
    
    // $('body').html(function(i, txt){
    //   // iterate over all words
    //   for(var i=0; i<filter.length; i++){
    //     // Create a regular expression and make it global
    //     var pattern = new RegExp('\\b' + filter[i] + '\\b', 'g');
    //     // Create a new string filled with '*'
    //     var replacement = '*'.repeat(filter[i].length);
    //     txt = txt.replace(pattern, replacement);
    //   }
    //   // returning txt will set the new text value for the current element
    //   return txt;
    // });
</script>
@endsection