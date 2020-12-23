@extends('front.layouts.master')

@section('meta_title'){{ $review->title }}@endsection
@section('meta_keyword'){{ $review->review_genre }}@endsection
@section('meta_desc'){{ str_limit(strip_tags($review->content),180,'...') }}@endsection
@section('meta-tags')
    <meta name="og:image" content="{{ asset('storage/' . $review->photo()) }}"/>
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -190px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <a href="{{ route('creator.detail', $review->user->username) }}">
                    <h4 class="text-primary text-shadow">{{ $review->user->name }},</h4>
                </a>
                <h1 class="text-white font-weight-bold" data-font-size="40px">"{{ $review->title }}"</h1>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="card card-body bd-radius-4 shadow">
                    {{-- Reviews --}}
                    <div class="row no-pm">
                        <div class="col-md-3 col-12 no-pm">
                            <div class="card-img-wrap mb-2" data-toggle="tooltip" data-placement="top" title="{{ $review->review_name }}">
                                <img class="img-review mx-auto d-block shadow-sm" loading="lazy"
                                    src="{{ asset('storage/' . $review->photo()) }}" alt="">
                                <div class="card-img-overlay">
                                    <?php
                                    if($review->score < 7 && $review->score > 5){
                                        $score_color = 'warning';
                                    }elseif($review->score < 5){
                                        $score_color = 'danger';
                                    }else{
                                        $score_color = 'success';
                                    }   
                                    ?>
                                    <div class="badge badge-{{ $score_color }} align-self-center bd-radius-4 shadow">
                                        <span>Score</span>
                                        <h4 class="no-pm">{{ $review->score }}/10</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 no-pm">
                            <ul class="nav nav-tabs" id="review-info-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold active" id="review-info-tab2" data-toggle="tab"
                                        href="#review-info" role="tab" aria-controls="home" aria-selected="true">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="profile-tab2" data-toggle="tab"
                                        href="#synopsis" role="tab" aria-controls="profile"
                                        aria-selected="false">Plot</a>
                                </li>
                            </ul>
                            <div class="tab-content mx-3" id="myTab3Content">
                                <div class="tab-pane fade show active" id="review-info" role="tabpanel"
                                    aria-labelledby="review-info">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <span class="text-small">Title</span>
                                            <h6>{{ $review->review_name }}</h6>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span class="text-small">Release Date</span>
                                            <h6>{{ $review->review_releasedate }}</h6>
                                        </div>
                                        @if ($review->tags[0])
                                        <div class="col-12 col-md-12">
                                            <span class="text-small">Genre</span>
                                            <div class="badges">
                                                @foreach ($review->tags as $tag)
                                                <a href="{{ route('tag','tag='.$tag->slug) }}" class="badge badge-primary">{{$tag->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
    
                                        @if ($review->review_studio)
                                        <div class="col-12 col-md-6">
                                            <span class="text-small">Studio/Publisher</span>
                                            <h6>{{ $review->review_studio }}</h6>
                                        </div>
                                        @endif
    
                                        @if ($review->review_link)
                                        <div class="col-12 col-md-6">
                                            <span class="text-small">Source</span>
                                            <a href="https://{{ $review->review_link }}" target="_blank">
                                                <h6>{{ $review->review_link }}</h6>
                                            </a>
                                        </div>
                                        @endif
    
                                        <div class="col-12 col-md-12">
    
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="synopsis" role="tabpanel" aria-labelledby="synopsis">
                                    <div class="text-synopsis">{!! $review->review_synopsis !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 bd-radius-4 shadow my-2">
                    <div class="card-header">
                        <h4 class="no-pm">Review</h4>
                        <div class="card-header-action">
                            <a data-collapse="#review-collapse" class="btn btn-icon btn-primary" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="review-collapse">
                        <div class="card-body">
                            <p>{!! $review->content !!}</p>
                        </div>
                    </div>
                </div>
                @if ($review->recommend)
                <div class="card border-0 bd-radius-4 shadow my-2">
                    <div class="card-header">
                        <h4 class="no-pm">I'll Recommend You If..</h4>
                        <div class="card-header-action">
                            <a data-collapse="#recommend-collapse" class="btn btn-icon btn-primary" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="recommend-collapse">
                        <div class="card-body">
                            <p>{{ $review->recommend }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if ($review->unrecommend)
                <div class="card border-0 bd-radius-4 shadow my-2">
                    <div class="card-header">
                        <h4 class="no-pm">I'll Unrecommend You If..</h4>
                        <div class="card-header-action">
                            <a data-collapse="#unrecommend-collapse" class="btn btn-icon btn-primary" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="unrecommend-collapse">
                        <div class="card-body">
                            <p>{{ $review->unrecommend }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card border-0 bd-radius-4 shadow my-2">
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