@extends('front.layouts.master')

@section('content')

@include('front.creator.creator-hero')

@php
$fullname = $user->name;
$fullname = trim($fullname); // remove double space
$firstname = substr($fullname, 0, strpos($fullname, ' '));
$lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
@endphp

<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @include('front.creator.creator-nav')
                @if ($review[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                    <p class="lead">
                        {{ $user->name }} belum mengupload Review saat ini
                    </p>
                </div>
                @else
                @include('front.layouts.review-card', ['col' => '3'])
                <div class="d-flex justify-content-center mt-4">
                    {!! $review->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection