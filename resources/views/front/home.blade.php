@extends('front.layouts.master')

@section('content')
@guest
<div class="jumbotron jumbotron-fluid bg-front mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-none d-sm-block d-sm-block">
                <div class="card card-body shadow rounded">
                    <img class="img-responsive align-self-center" src="{{ asset('gambar/mock-1.png') }}" alt=""
                        data-max-width="250px">
                    <h5 class="text-dark">Join Us and Start Sharing Your Creations</h5>
                    <p data-font-size="14px" class="font-weight-normal">
                        You can upload your creations from hobby, works, portofolio and sharing with others.
                    </p>
                    <div class="mt-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-block">Join with us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 align-self-center">
                <h1 class="text-dark font-weight-bold">Upload Your Creation!</h1>
                <p class="mb-4 text-dark" data-font-size="16px">
                    Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI Design, Illustration, Reviews and
                    more.
                </p>
                <a class="btn btn-dark btn-lg font-weight-bold" href="{{ url('creation') }}" role="button">Browse
                    Creation</a>
            </div>
        </div>
    </div>
</div>
@endguest

<div class="section">
    <div class="container">
        <div class="row">
            @include('front.partial.left-bar')
            @include('front.partial.latest-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection