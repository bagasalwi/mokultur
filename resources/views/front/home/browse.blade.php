@extends('front.layouts.master')

@section('content')
<div class="section">
    <div class="container">
        <div class="my-4">
            <p class="no-pm">{{ isset($search_meta ) ? 'Showing result for :' : 'Search An Article or Reviews :'  }}</p>
            <form action="{{ route('post') }}" role="search">
                <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                    value="{{ isset($search_meta ) ? $search_meta : ""  }}">
            </form>
        </div>
        <div class="row">
            <div class="col-lg-9 col-sm-12">

                <div class="hero primary-gradient text-white bd-radius-4 mb-3">
                    <div class="hero-inner">
                        <h1 class="text-white">More Like, A Geek's Playground</h1>
                        <p class="lead text-white">We just offering a place to upload, and as you know.. You all are our filler.</p>
                    </div>
                </div>

                @foreach ($review as $p)
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <a href="{{ route('review.detail',$p->slug) }}" class="card-block clearfix">
                        <div class="card border-0 mb-2">
                            <div class="card-img-wrap mb-2 bd-radius-4">
                                <img class="img-fluid img-imagereview" loading="lazy"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                            </div>
                            <h5><a class="text-dark font-weight-bold"
                                    href="{{ route('review.detail',$p->slug) }}">{{ $p->title }}</a></h5>
                            <div class="text-secondary no-pm">
                                {{ str_limit(strip_tags($p->content),70,'...') }}
                            </div>
                            <div class="align-items-end mt-2">
                                <p class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a
                                        href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->username) }}</a>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <hr>
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-md-4">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagepost" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                </div>
                                <h4><a class="text-dark font-weight-bold"
                                        href="{{ route('post.detail',$p->slug) }}">{{ $p->title }}</a></h4>
                                <div class="text-secondary no-pm">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </div>
                                <div class="align-items-end mt-2">
                                    <p class="text-secondary">
                                        {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
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