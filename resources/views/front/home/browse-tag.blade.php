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
                @if (!isset($post[0]) && !isset($review[0]))
                @if (isset($all_tags[0]))
                <div class="badges">
                    @foreach ($all_tags as $tag)
                    <a href="{{ route('tag','tag='.$tag->slug) }}" class="badge badge-primary">{{$tag->name}}</a>
                    @endforeach
                </div>
                @endif
                @else

                <div class="mr-auto">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="article-tab3" data-toggle="tab" href="#article-tag"
                                role="tab" aria-controls="article" aria-selected="true">Article</a>
                            <a class="nav-link" id="review-tab3" data-toggle="tab" href="#review-tag" role="tab"
                                aria-controls="review" aria-selected="false">Review</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="article-tag" role="tabpanel"
                        aria-labelledby="article-tab3">
                        @if (isset($post[0]))
                        <div id="posts" class="row">
                            @foreach ($post as $p)
                            <div class="col-md-6">
                                <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}"
                                    class="card-block clearfix">
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
                                                {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }}
                                                &middot; <a
                                                    href="{{ route('creator.detail', $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center my-2">
                            {!! $post->render() !!}
                        </div>
                        @else
                        <div class="empty-state" data-height="400">
                            <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                            <h2>Tidak ada Article terkait</h2>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="review-tag" role="tabpanel" aria-labelledby="review-tab3">
                        @if (isset($review[0]))
                        @include('front.layouts.review-card', ['col' => '4'])
                        <div class="d-flex justify-content-center my-2">
                            {{ $review->fragment('review-tag')->links() }}
                        </div>
                        @else
                        <div class="empty-state" data-height="400">
                            <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                            <h2>Tidak ada Review terkait</h2>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection