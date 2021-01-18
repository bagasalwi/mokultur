@extends('front.layouts.master')

@section('meta_title'){{ $review->title }}@endsection
@section('meta_keyword'){{ $review->review_genre }}@endsection
@section('meta_desc'){{ str_limit(strip_tags($review->content),180,'...') }}@endsection
@section('meta-tags')
<meta name="og:image" content="{{ asset('storage/' . $review->photo()) }}" />
@endsection

@section('content')

<?php
    if($review->score < 7 && $review->score > 5){
        $score_color = 'warning';
    }elseif($review->score < 5){
        $score_color = 'danger';
    }else{
        $score_color = 'success';
    }   
?>

<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -200px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                {{-- <a href="{{ route('creator.detail', $review->user->username) }}">
                    <h4 class="text-white">{{ $review->user->name }},</h4>
                </a> --}}
                {{-- <h1 class="text-white fw-700" data-font-size="40px">{{ $review->title }}</h1> --}}
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="card card-body bd-radius-4">
                    {{-- Reviews --}}
                    <div class="row no-pm">
                        <div class="col-md-3 col-12 no-pm">
                            <div class="card-img-wrap mb-2" data-toggle="tooltip" data-placement="top"
                                title="{{ $review->review_name }}">
                                <img class="img-review mx-auto d-block shadow-sm" loading="lazy"
                                    src="{{ asset('storage/' . $review->photo()) }}" alt="">
                                <div class="card-img-overlay d-block d-sm-none">
                                    <div class="badge badge-{{ $score_color }} align-self-center bd-radius-2 shadow">
                                        <span>Score</span>
                                        <p class="no-pm">{{ $review->score }}/10</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12 no-pm">
                            <ul class="nav nav-tabs" id="review-info-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold active" id="review-info-tab2" data-toggle="tab"
                                        href="#review-info" role="tab" aria-controls="home"
                                        aria-selected="true">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="profile-tab2" data-toggle="tab"
                                        href="#synopsis" role="tab" aria-controls="profile"
                                        aria-selected="false">Plot</a>
                                </li>
                                @if ($review->review_link)
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="profile-tab2" data-toggle="tab"
                                        href="#trailer" role="tab" aria-controls="profile"
                                        aria-selected="false">Trailer</a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content mx-3" id="myTab3Content">
                                <div class="tab-pane fade show active review-info" id="review-info" role="tabpanel"
                                    aria-labelledby="review-info">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-small">Title</span>
                                            <h6>{{ $review->review_name }}</h6>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-small">Release Date</span>
                                            <h6>{{ $review->review_releasedate }}</h6>
                                        </div>
                                        @if ($review->tags[0])
                                        <div class="col-12">
                                            <span class="text-small">Genre</span>
                                            <div class="badges">
                                                @foreach ($review->tags as $tag)
                                                <a href="{{ route('tag','tag='.$tag->slug) }}"
                                                    class="badge badge-primary">{{$tag->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if ($review->review_studio)
                                        <div class="col-12">
                                            <span class="text-small">Studio/Publisher</span>
                                            <h6>{{ $review->review_studio }}</h6>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="synopsis" role="tabpanel" aria-labelledby="synopsis">
                                    <div class="text-synopsis">{!! $review->review_synopsis !!}</div>
                                </div>
                                @if ($review->review_link)
                                <div class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="synopsis">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/{{ $review->review_link }}"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-12 no-pm d-none d-lg-block">
                            <div class="card card-block bd-radius-4 d-flex bg-{{ $score_color }}">
                                <div class="card-body align-items-center d-flex justify-content-center">
                                    <h2 class="fw-700 no-pm">{{ $review->score }}/10</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="fw-700 mt-4" data-font-size="46px">{{ $review->title }}</h1>
                <p class="p-0 m-0"><small class="text-dark">Published
                    {{ $review->created_at->format('d-M-Y') }}</small></p>

                <a href="{{ route('creator.detail', $review->user->username) }}" class="clearfix">
                    <div class="card card-hover bd-radius-4 shadow-sm py-1 px-2 my-4">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="d-flex justify-content-center">
                                    <img class="rounded-circle" width="100" height="100"
                                        src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 align-self-center my-2">
                                <span class="badge badge-info">Reviewer</span>
                                <div class="my-1">
                                    <h4 class="no-pm">{{ $user->name }}</h4>
                                </div>
                                <p class="text-secondary no-pm">{{ $user->description }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="content my-4">{!! $review->content !!}</div>

                @if ($review->recommend)
                <div class="card my-3">
                    <div class="card-header bg-primary">
                        <h4 class="no-pm text-white">Sangat Rekomendasi Jika..</h4>
                        <div class="card-header-action">
                            <a data-collapse="#recommend-collapse" class="btn btn-icon btn-light" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="recommend-collapse">
                        <div class="card-body bg-secondary">
                            <p>{{ $review->recommend }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if ($review->unrecommend)
                <div class="card my-3">
                    <div class="card-header bg-primary">
                        <h4 class="no-pm text-white">Kurang Rekomendasi Jika..</h4>
                        <div class="card-header-action">
                            <a data-collapse="#unrecommend-collapse" class="btn btn-icon btn-light" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="unrecommend-collapse">
                        <div class="card-body bg-secondary">
                            <p>{{ $review->unrecommend }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card border-0 my-4">
                    <div class="card-body">
                        <div class="mt-2" id="disqus_thread"></div>
                    </div>
                </div>
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
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
        powered by Disqus.</a></noscript>
<script>
    $(document).ready(function(){
        $('#review-collapse img').addClass('img-fluid');
        $("iframe").addClass("embed-responsive embed-responsive-1by1 embed-responsive-item");
    });

    $("#carousel-post").owlCarousel({
        items:1,
        // margin:10,
        autoHeight:true,
        nav: true,
        dots: false,
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
    });
</script>
@endsection