@extends('front.layouts.master')

@section('content')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="card-img-wrap bd-radius-4">
                    <img class="img-fluid  bd-radius-4 mx-auto d-block shadow-sm" loading="lazy"
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

                <div class="stickydiv my-4">
                    <div class="card card-body border-0 bd-radius-4 shadow">
                        <span class="text-dark mb-2">Title</span>
                        <h5 class="ml-2">{{ $review->review_name }}</h5>

                        <span class="text-dark mb-2">Release Date</span>
                        <h5 class="ml-2">{{ $review->review_releasedate }}</h5>

                        @if ($review_genre)
                        <span class="text-dark mb-2">Genre</span>
                        <div class="badges">
                            @foreach ($review_genre as $tag)
                            <a href="#" class="badge badge-primary" value="{{$tag}}">{{$tag}}</a>
                            @endforeach
                        </div>
                        @endif

                        @if ($review->review_studio)
                        <span class="text-dark mb-2">Studio/Publisher</span>
                        <h5 class="ml-2">{{ $review->review_studio }}</h5>
                        @endif

                        @if ($review->review_link)
                        <span class="text-dark mb-2">Source</span>
                        <a class="ml-2" href="https://{{ $review->review_link }}">
                            <h5>{{ $review->review_link }}</h5>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card card-body border-0 bd-radius-4 shadow-sm d-flex flex-row">
                    <div class="mr-auto align-self-center">
                        <a href="{{ url('creator/' . $review->user->username) }}">
                            <h6 class="text-primary">{{ $review->user->name }},</h6>
                        </a>
                        <h3 class="no-pm">"{{ $review->title }}"</h3>
                    </div>
                </div>
                <div class="card border-0 bd-radius-4 shadow my-2">
                    <div class="card-header">
                        <h4 class="no-pm">Synopsis / Plot</h4>
                        <div class="card-header-action">
                            <a data-collapse="#plot-collapse" class="btn btn-icon btn-primary" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="plot-collapse">
                        <div class="card-body">
                            <p>{!! $review->review_synopsis !!}</p>
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
</script>
@endsection