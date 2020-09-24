@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid mb-0" data-background-topic="{{ asset('storage/' . $category->banner) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 data-font-size="80px" class="text-white font-weight-bold">{{ $category->name }}</h1>
                <p class="mb-4 text-white" data-font-size="22px">
                    {{ $category->description }}
                </p>
            </div>
        </div>
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