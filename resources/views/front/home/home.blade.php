@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-4 col-sm-12 my-2">
                @include('layouts.side-profile')
            </div>
            <div class="col-md-8 col-sm-12 my-2">
                <div class="row">
                    <div class="col-12 mb-4">
                        @include('layouts.top-menu')
                        <div class="hero text-white bg-primary mt-2">
                            <div class="hero-inner">
                                <h2>Welcome, {{ $user->name }} !</h2>
                                <p class="lead">Selamat datang di Kreasi Bangsa, Bersama kita tampilkan kreasi anak
                                    bangsa !</p>
                            </div>
                        </div>
                    </div>
                    @foreach ($post as $p)
                    <div class="col-md-6 mb-4">
                        <div class="card card-hover h-100">
                            <div class="card-header border-bottom">
                                <img alt="image" width="45" height="45"
                                    src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                                    class="rounded-circle mr-2">
                                <h6><a href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a></h6>
                            </div>
                            <div class="embed-responsive embed-responsive-4by3">
                                <img class="embed-responsive-item img-fluid"
                                    src="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}" alt="">
                            </div>
                            <div class="card-body border-top">
                                <a class="stretched-link" href="{{ url('creation/' . $p->slug) }}">
                                    <h6>{{ $p->title }}</h6>
                                </a>
                                <div class="mt-2">
                                    <a><i class="fas fa-eye"></i> {{ $p->view_count }}</a>
                                    <div class="bullet"></div>
                                    <a>{{ $p->category->name }}</a>
                                    <a class="float-right">{{ $p->created_at->diffForHumans() }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col d-flex justify-content-center">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection