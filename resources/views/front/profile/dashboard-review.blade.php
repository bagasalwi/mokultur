@extends('front.layouts.master')

@section('content')
@include('front.profile.dashboard-hero')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 my-4">
                @include('front.profile.dashboard-nav')
                <hr>
                @if ($review[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Review</h2>
                    <a href="{{ route('review') }}" class="btn btn-primary">Buat Review</a>
                </div>
                @else
                @include('front.layouts.review-card', ['col' => '3'])
                <div class="d-flex justify-content-center mt-4">
                    @if ($review->hasMorePages())
                        {!! $review->render() !!}
                    @else
                    <h6 class="text-secondary">No More Data</h6>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection