@extends('front.layouts.master')

@section('meta_title')Browse @endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-4 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Browse Article & Reviews here!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Its Just Browse another and another bla bla.. Get your kind of interest Article or Reviews, here.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <a href="{{ route('review') }}" class="card-block clearfix">
                    <div class="hero primary-gradient text-white mb-3 card-hover bd-radius-4">
                        <div class="hero-inner">
                            <h1 class="text-white">Reviews</h1>
                            <p class="lead text-white">A place for you to share your personal opinion about Movies,
                                Anime, Comics, Tv Series or Game.</p>
                        </div>
                    </div>
                </a>
                <div class="row">
                    @foreach ($review as $p)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3">
                        <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}"
                            class="card-block clearfix">
                            <div class="card border-0 shadow">
                                <div class="card-img-wrap">
                                    <img class="card-img-top img-fluid img-imagereview" loading="lazy"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                    <div class="card-img-overlay">
                                        <?php
                                        if($p->score < 7 && $p->score > 5){
                                            $score_color = 'warning';
                                        }elseif($p->score < 5){
                                            $score_color = 'danger';
                                        }else{
                                            $score_color = 'success';
                                        }   
                                        ?>
                                        <div class="badge badge-{{ $score_color }} align-self-center bd-radius-2">
                                            <span>Score</span>
                                            <h6 class="no-pm">{{ $p->score }}/10</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @php
                                    $tags = explode(',',$p->review_genre);   
                                    @endphp
                                    <div class="scrolling-wrapper-flexbox">
                                        <div class="badges">
                                            @foreach ($tags as $tag)
                                            <a href="#" class="badge badge-primary"
                                                value="{{$tag}}">{{$tag}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h6><a class="text-dark font-weight-bold"
                                            href="{{ route('review.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a>
                                    </h6>
                                    <hr>
                                    <small class="text-secondary no-pm">
                                        {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a href="{{ route('creator.detail', $p->user->username) }}">{{ '@'.strtoupper($p->user->username) }}</a>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('post') }}" class="card-block clearfix">
                    <div class="hero primary-gradient text-white mb-3 card-hover bd-radius-4">
                        <div class="hero-inner">
                            <h1 class="text-white">Articles</h1>
                            <p class="lead text-white">A place for you to share your Stories, Knowledge, Experience,
                                Tutorials, Foodies and more.</p>
                        </div>
                    </div>
                </a>
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-md-4">
                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagepost" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                </div>
                                <h4><a class="text-dark font-weight-bold"
                                        href="{{ route('post.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a>
                                </h4>
                                <div class="text-secondary no-pm">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </div>
                                <div class="align-items-end mt-2">
                                    <p class="text-secondary">
                                        {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ route('creator.detail', $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection