@extends('front.layouts.master')

@section('content')
@guest
<div class="jumbotron jumbotron-fluid primary-gradient mb-0" style="padding-bottom: 200px; margin-bottom: -250px !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h1 data-font-size="48px" class="text-white font-weight-bold">Article, Stories, Reviews, whatever you
                    want to post!</h1>
                <p class="mb-4 text-white">
                    In Kreasibangsa you can share all your creations to share with others!
                </p>
                <a class="btn btn-light btn-lg mr-2" href="{{ route('post') }}" role="button">Sign In</a>
                <a class="btn btn-outline-white btn-lg" href="{{ route('post') }}" role="button">Browse Creation</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="m-0 w-100 animated" id="anijson"></div>
            </div>
        </div>
    </div>
</div>
@endguest

<div class="section">
    <div class="container card card-body border-0 bd-radius-8 shadow mb-4">
        <div class="row my-2">
            <div class="col-lg-6 col-sm-12 mb-2">
                <div class="stickydiv">
                    <h4 class="">Recent Article</h4>
                    @foreach ($creation as $idx => $p)
                    @if ($idx == 0)
                    <div class="card border-0 my-2">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card-img-wrap bd-radius-4">
                                <img class="img-fluid img-imagepost-headline" loading="lazy" data-max-height="400px"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                <div class="card-img-overlay text-white">
                                    <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                </div>
                            </div>
                        </a>
                        <div class="my-2">
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
            <div class="col-lg-6 col-sm-12 mb-2 d-none d-lg-block">
                {{-- <h4 class="">Recent Article</h4> --}}
                @foreach ($creation as $idx => $p)
                @if($idx != 0)
                <div class="card border-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
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
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-title">
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
                <div class="card border-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
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
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-title">
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
                <div class="card border-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
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
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-title">
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
                <div class="card border-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
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
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-title">
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
{{-- </div>
<div class="section"> --}}
    <div class="jumbotron jumbotron-fluid pattern-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-1 align-self-center">
                    <h1 class="text-primary font-weight-bold" data-font-size="48px">Check Out our Special Topic's Event!
                    </h1>
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