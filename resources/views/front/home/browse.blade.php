@extends('front.layouts.master')

@section('meta_title')Browse @endsection

@section('content')
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
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card-img-wrap mb-2 bd-radius-4">
                                <img class="img-fluid img-imagereview" loading="lazy"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                            </div>
                            <h5><a class="text-dark font-weight-bold"
                                    href="{{ route('review.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a></h5>
                            <div class="text-secondary no-pm">
                                {{ str_limit(strip_tags($p->content),70,'...') }}
                            </div>
                            <div class="align-items-end mt-2">
                                <p class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a
                                        href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->username) }}</a>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('post') }}" class="card-block clearfix">
                    <div class="hero primary-gradient text-white mb-3 card-hover bd-radius-4">
                        <div class="hero-inner">
                            <h1 class="text-white">Articles</h1>
                            <p class="lead text-white">A place for you to share your Stories, Knowledge, Experience, Tutorials, Foodies and more.</p>
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
                                        href="{{ route('post.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a></h4>
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