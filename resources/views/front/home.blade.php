@extends('front.layouts.master')

@section('content')
@guest
<div class="jumbotron jumbotron-fluid pattern-1 mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-none d-sm-block d-sm-block">
                <div class="card card-body shadow rounded">
                    <img class="img-responsive align-self-center" src="{{ asset('gambar/mock-1.png') }}" alt=""
                        data-max-width="200px">
                    <h5>Join Us and Start Sharing Your Creations</h5>
                    <p data-font-size="12px" class="font-weight-normal">
                        You can upload your creations from hobby, works, portofolio and sharing with others.
                    </p>
                    <div class="mt-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-block">Join with us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 align-self-center">
                <h1 class="text-dark font-weight-bold">Article, Stories, Reviews, whatever you want to post!</h1>
                <p class="mb-4 text-dark" data-font-size="16px">
                    In Kreasibangsa you can share all your creations to share with others!
                </p>
                <a class="btn btn-dark btn-lg" href="{{ url('creation') }}" role="button"><h6 class="m-0">Browse
                    Creation</h6></a>
            </div>
        </div>
    </div>
</div>
@endguest

<div class="section">
    <div class="container">
        <div class="row">
            @include('front.partial.left-bar')
            {{-- @include('front.partial.latest-post') --}}
            @include('front.partial.right-bar')
        </div>
        <hr>
        <div class="row mt-4">
            @include('front.partial.index-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection