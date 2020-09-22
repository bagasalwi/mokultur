@extends('front.layouts.master')

@section('content')

<div class="owl-carousel owl-theme slider d-none d-sm-block" id="slider2">
    @foreach ($category as $slider)
    <div>
        <img alt="image" class="img-slider" src="{{ asset('storage/' . $slider->banner) }}">
        <div class="slider-caption text-center">
            <div class="slider-title">
                <h1 data-font-size="80px" class="text-white">{{ $slider->name }}</h1>
            </div>
            <div class="slider-description">{{ $slider->description }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="container mt-4">
    <h5 class="text-dark">All Topic Categories</h5>
    <div class="row">
        @foreach ($category as $category)
        <div class="col-lg-4">
            <div class="card card-topic" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-self-center">
                            <h1 class="text-white">{{ $category->name }}</h1>
                            <p class="text-white font-weight-normal">{{ $category->description }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

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