@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-gradient mb-0"
    style="padding-bottom: 250px; margin-bottom: -250px !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="36px"><span id="switchtext">Article</span>, Post Whatever You Wanna Post, Freely!</h1>
                <p class="mb-3 text-white">
                    Kreasibangsa is Open Space for everyone who want to share their thoughts within an article or a reviews in every aspect like Geeks, Pop Culture, Movies, Technology, Design, and Many More.
                </p>
                <div class="d-none d-lg-block">
                    @guest
                    <a class="btn btn-light px-4 mr-1" href="{{ route('post') }}" role="button">Sign In</a>
                    @endguest
                    <a class="btn btn-outline-white px-4 mr-1" href="{{ route('browse') }}" role="button">Browse</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="m-0 animated" id="anijson" style="width: 90%"></div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="card border-0 bd-radius-8 shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="stickydiv">
                            @foreach ($top_creation as $idx => $p)
                            @if ($idx == 0)
                            <div class="card border-0 mb-2">
                                <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                                    <div class="card-img-wrap bd-radius-4">
                                        <img class="img-fluid img-imagepost-headline" loading="lazy"
                                            data-max-height="400px" src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                    </div>
                                </a>
                                <div class="my-2">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="no-pm">
                                        <h3>{{ $p->title }}</h3>
                                    </a>
                                    <p class="card-text">
                                        {{ str_limit(strip_tags($p->description),180,'...') }}
                                    </p>
                                </div>
                                <small class="text-secondary mt-2">
                                    {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                    {{ $p->user->name }}
                                </small>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 d-none d-lg-block">
                        @foreach ($top_creation as $idx => $p)
                        @if($idx > 0)
                        <div class="card border-0 my-3">
                            <div class="row no-gutters">
                                <div class="col-sm-4">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                                        <div class="card-img-wrap bd-radius-4">
                                            <img class="card-img img-imagepost-headline" loading="lazy" height="150vh"
                                                src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mx-2 py-0">
                                        <a href="" class="text-primary">
                                            <h6>{{ $p->category->name }}</h6>
                                        </a>
                                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-title">
                                            <h4>
                                                {{ $p->title }}
                                            </h4>
                                        </a>
                                        <p class="card-text">
                                            {{ str_limit(strip_tags($p->description),80,'...') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid pattern-1 bg-light">
        <div class="container">
            <a href="{{ route('review') }}" class="card-block clearfix">
                <div class="hero primary-pattern-1 text-white mb-3 card-hover bd-radius-4">
                    <div class="hero-inner">
                        <h1 class="text-white">Reviews</h1>
                        <p class="lead text-white">A place for you to share your personal opinion about Movies,
                            Anime, Comics, Tv Series or Game. <span class="font-weight-bold">Click This Banner For
                                More</span></p>
                    </div>
                </div>
            </a>
            <div class="row">
                @foreach ($review as $p)
                <div class="col-lg-3 col-md-6 col-sm-6 my-2">
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
                                <div class="scrolling-wrapper-flexbox mb-2">
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
                                    {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a href="{{ url('creator/' . $p->user->username) }}">{{ '@'.strtoupper($p->user->username) }}</a>
                                </small>
                            </div>
                        </div>
                    </a>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('front.partial.left-bar')
            @include('front.partial.latest-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>

@endsection