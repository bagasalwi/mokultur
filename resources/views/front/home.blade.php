@extends('front.layouts.master')

@section('content')
@guest
<div class="jumbotron jumbotron-fluid pattern-1 mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-1 align-self-center">
                <h1 class="text-dark font-weight-bold" data-font-size="48px">Article, Stories, Reviews, whatever you
                    want to post!</h1>
                <p class="mb-4 text-dark" data-font-size="20px" style="line-height:120%;">
                    In Kreasibangsa you can share all your creations to share with others!
                </p>
                <a class="btn btn-dark btn-lg" href="{{ route('post') }}" role="button">Browse Creation</a>
            </div>
            <div class="col-lg-12">

            </div>
        </div>
    </div>
</div>
@endguest

<div class="section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-6 col-sm-12 mb-2">
                <div class="stickydiv">
                    @foreach ($creation as $idx => $p)
                    @if ($idx == 0)
                    <div class="card border-0 my-2">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card-img-wrap">
                                <img class="img-fluid img-imagepost-headline" loading="lazy"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                <div class="card-img-overlay text-white">
                                    <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                </div>
                            </div>
                        </a>
                        <div class="my-1">
                            <a href="{{ route('post.detail',$p->slug) }}" class="no-pm">
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
            <hr class="d-lg-none">
            <div class="col-lg-6 col-sm-12 mb-2">
                <h2 class="no-pm">Recent Article</h2>
                @foreach ($creation as $idx => $p)
                @if($idx != 0)
                <div class="list-group">
                    <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix d-flex align-self-center">
                        {{-- <div class="card"> --}}
                        <div class="card-horizontal">
                            <img class="img-imagepost-hr" loading="lazy" src="{{ asset('storage/' . $p->photo()) }}"
                                alt="">
                            <div class="card-body">
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-title">
                                    <h5>
                                        {{ $p->title }}
                                    </h5>
                                </a>
                                <p class="card-text">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </p>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid pattern-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-1 align-self-center">
                    <h1 class="text-dark font-weight-bold" data-font-size="48px">Check Out our Special Topic's Event!</h1>
                    <p class="mb-4 text-dark" data-font-size="20px" style="line-height:120%;">
                        Based on Editor's Choice, we present Topic's Event Monthly.
                    </p>
                    <a class="btn btn-dark btn-lg" href="{{ route('post') }}" role="button">Go To Event</a>
                </div>
                <div class="col-lg-12">
    
                </div>
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