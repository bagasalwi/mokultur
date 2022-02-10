@extends('front.layouts.master')

@section('content')

{{-- <div class="jumbotron jumbotron-fluid primary-pattern-1 pb-0">
    <div class="mini-section">
        <div class="container">
            <div class="card card-body bd-radius-8 shadow border-0">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-12 my-2">
                        <div class="d-flex justify-content-center">
                            <img class="rounded-circle img-cover" width="120" height="120"
                                src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 d-flex flex-column align-self-center my-2">
                        <small>Active since {{ $user->created_at->format('M Y') }}</small>
                        <div class="my-1">
                            <h1 class="no-pm">{{ $user->name }}</h1>
                        </div>
                        <p class="text-secondary">{{ $user->description }}</p>
                        <div class="flex-row">
                            @if ($user->facebook)
                            <a class="btn btn-facebook" href="https://facebook.com/{{ $user->facebook }}"
                                target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            @endif
                            @if($user->instagram)
                            <a class="btn btn-instagram" href="https://instagram.com/{{ $user->instagram }}"
                                target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- 
<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @include('front.creator.creator-nav')
                <hr>
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
                    <div class="col-lg-4 col-md-4">
                        <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 my-2 px-0">
                                <div class="card-img-wrap">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}"
                                        alt="">
                                </div>
                                <div class="mt-1">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}">
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
</section> --}}

@endsection