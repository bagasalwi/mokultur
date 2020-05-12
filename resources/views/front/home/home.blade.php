@extends('front.layouts.master')

@section('content')
<div class="main-content">
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
            <div class="col-md-4 col-sm-12">
                @include('layouts.side-profile')
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-12 mb-4">
                        @include('layouts.top-menu')
                        <div class="hero text-white bg-primary">
                            <div class="hero-inner">
                                <h2>Welcome, {{ $user->name }} !</h2>
                                <p class="lead">Selamat datang di Kreasi Bangsa, Bersama kita tampilkan kreasi anak
                                    bangsa !</p>
                                <div class="mt-4">
                                    <a href="{{ url('post/create') }}"
                                        class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                            class="fas fa-plus mr-1"></i> TAMBAH KARYA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($post as $p)
                    <div class="col-md-12">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a>{{ $p->category->name }}</a>
                                    <div class="bullet"></div> <a>{{ $p->created_at->diffForHumans() }}</a>
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $p->title }}</a></h2>
                                </div>
                                <div class="article-user">
                                    <img alt="image" width="30" height="45" src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}">
                                    <div class="article-user-details">
                                        <div class="user-detail-name">
                                            <a href="#">{{ $p->user->name }}</a>
                                        </div>
                                        @if ($p->user->instagram != null)
                                        <div class="text-job">{{ '@'.$p->user->instagram }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                    <div class="col d-flex justify-content-center">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection