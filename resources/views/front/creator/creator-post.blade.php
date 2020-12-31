@extends('front.layouts.master')

@section('content')

@section('meta_title'){{'@'.$user->username }} @endsection
@section('meta_desc'){{ str_limit(strip_tags($user->description),180,'...') }}@endsection

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
                @if ($post[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                    <p class="lead">
                        {{ $user->name }} Belum Mengupload Article Saat Ini
                    </p>
                </div>
                @else
                <div id="posts" class="row">
                    @foreach ($post as $p)
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 my-2">
                                <div class="card-img-wrap bd-radius-8">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}"
                                        alt="">
                                    {{-- <div class="card-img-overlay text-white">
                                        <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                    </div> --}}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}">
                                        <h4 class="no-pm">{{ $p->title }}</h4>
                                    </a>
                                </div>
                                <small class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                    {{ $p->user->name }}
                                </small>
                            </div>
                        </a>

                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                   {!! $post->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection