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
                    <div class="hero bg-black text-white mb-3 card-hover no-bd">
                        <div class="hero-inner">
                            <h1 class="text-white">Mokultur <span class="text-primary">Review's</span></h1>
                            <p class="lead text-white no-pm">Tempat review-review film atau anime dari kreator paling edgy di mokultur, Semua reviewnya se-enak jidatnya! <span class="font-weight-bold">Klik disini untuk liat lengkapnya!</span></p>
                        </div>
                    </div>
                </a>
                @include('front.layouts.review-card', ['col' => '4'])

                <a href="{{ route('post') }}" class="card-block clearfix">
                    <div class="hero bg-black text-white mb-3 card-hover no-bd">
                        <div class="hero-inner">
                            <h1 class="text-white">Mokultur <span class="text-primary">Article's</span></h1>
                            <p class="lead text-white no-pm">Tempat Sharing para author Mokultur! Biasanya Sharing artikel random berupa Stories, Knowledge, Experience, Tutorial dan Lainnya.. <span class="font-weight-bold">Klik disini untuk liat lengkapnya!</span></p>
                        </div>
                    </div>
                </a>
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-md-6">
                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagepost" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                </div>
                                <h5><a class="text-dark fw-700"
                                        href="{{ route('post.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a></h5>
                                <div class="text-secondary no-pm">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </div>
                                <div class="align-items-end mt-2">
                                    <p class="text-secondary">
                                        <small>
                                            {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ route('creator.detail', $p->user->username) }}">{{ '@'.$p->user->username }}</a>
                                        </small>
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