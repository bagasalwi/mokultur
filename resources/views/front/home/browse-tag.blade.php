@extends('front.layouts.master')

@section('meta_title')Browse Tag @endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Tag's Room!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Browse tagged published Article and Reviews within all creators right here, Explore!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <div class="card card-body border-0 bd-radius-4 shadow-sm mb-4">
                    <p class="no-pm">{{ isset($search_meta ) ? 'Showing result for :' : 'Search Tag :'  }}</p>
                    <form action="{{ route('tag') }}" role="search">
                        <input type="text" id="search" name="tag" class="inputSearch" placeholder="Search.."
                            value="{{ isset($search_meta ) ? $search_meta : ""  }}">
                    </form>
                </div>
                @if (isset($review[0]))
                @foreach ($review as $p)
                <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                    <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}"
                        class="card-block clearfix">
                        <div class="card border-0 shadow h-100">
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
                                    {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a href="{{ route('creator.detail', $p->user->username) }}"">{{ '@'.strtoupper($p->user->username) }}</a>
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="text-center my-2">
                    {!! $review->render() !!}
                </div>
                @endif
                @if (isset($post[0]))
                <div id="posts" class="row">
                    @foreach ($post as $p)
                    <div class="col-md-6">
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
                <div class="text-center my-2">
                    {!! $post->render() !!}
                </div>
                @else
                @if (isset($all_tags[0]))
                <div class="badges">
                    @foreach ($all_tags as $tag)
                    <a href="{{ route('tag','tag='.$tag->slug) }}" class="badge badge-primary">{{$tag->name}}</a>
                    @endforeach
                </div>
                @endif
                @endif
            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection