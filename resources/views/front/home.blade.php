@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid" style="background-color:#ff6ca9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h2 class="display-5 text-white"><b class="text-white">Kreasi
                        Bangsa</b> memungkinkan kamu menyimpan kreasi /
                    karya </h2>
                {{-- <hr class="my-4"> --}}
                <p class="mb-4 text-white" style="font-size: 16px;">Kreasi bangsa merupakan sarana untuk mengenalkan
                    kreasi - kreasi anak bangsa, mulai
                    dari
                    sketch,
                    UI hingga ilustrasi.</p>
                <p class="lead">
                    <a class="btn btn-light btn-lg font-weight-bold" href="{{ url('creation') }}" role="button">Lihat
                        Kreasi</a>
                </p>
            </div>
            <div class="col-lg-6 d-none d-sm-block d-sm-block">
                <img width="450" src="{{ URL::asset('gambar/sketch/6.svg')}}">
            </div>
        </div>
    </div>
</div>

{{-- Kenapa kreasi bangsa? --}}
<section class="section">
    <div class="container">
        <div class="section-body">
            <div class="row text-center align-self-center">
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="200">
                    <span style="color: #ff6ca9;">
                        <i class="fas fa-palette fa-4x"></i>
                        <h4 class="text-primary mt-4">Karya</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="400">
                    <span style="color: #ff6ca9;">
                        <i class="fas fa-trophy fa-4x"></i>
                        <h4 class="text-primary mt-4">Portofolio</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="600">
                    <span style="color: #ff6ca9;">
                        <i class="fas fa-share-alt fa-4x"></i>
                        <h4 class="text-primary mt-4">Berbagi</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="800">
                    <span style="color: #ff6ca9;">
                        <i class="fas fa-photo-video fa-4x"></i>
                        <h4 class="text-primary mt-4">Media</h4>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<section class="section">
    <div class="container">
        <div class="section-body">
            <div class="row">
                <div class="col align-self-center" data-aos="fade-up">
                    <h1 class="mb-4 mr-2 text-dark">
                        Buat <b class="text-primary">Portofolio</b> mu sekarang !
                    </h1>
                    <p class="mb-4 mr-2">
                        Kamu dapat meng-upload kreasi - kreasi kamu sesuai dengan bidang yang kamu tekuni,
                        kreasi
                        kamu akan di tautkan dengan akun kamu sebagai karya dan portofolio.
                    </p>
                    <a class="btn btn-lg btn-outline-primary" href="{{ url('creator') }}" role="button">Lihat
                        Kreator</a>
                </div>
                <div class="col d-none d-sm-block" data-aos="fade-up" data-aos-delay="600">
                    <img width="550" src="{{ URL::asset('gambar/sketch/2.svg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KREASI TERBARU --}}
<section class="section" style="background-color:#ff6ca9;">
    <div class="container">
        <div class="section-body">
            <div class="row">
                <div class="col align-self-center text-center">
                    <h1 class="my-4 text-white">
                        KREASI TERBARU
                    </h1>
                </div>
            </div>
            <div class="row">
                @foreach ($post_latest as $p)
                <div class="col-md-4 mb-4">
                    <div class="card card-hover h-100" data-aos="fade-up" data-aos-delay="200">
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
            </div>
            <div class="align-self-center text-center">
                <a class="btn btn-lg btn-light mt-4" data-aos="zoom-out" data-aos-delay="600"
                href="{{ url('creation') }}" role="button">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-body">
            <div class="row">
                <div class="col d-none d-sm-block" data-aos="fade-right" data-aos-delay="300">
                    <img width="450" src="{{ URL::asset('gambar/sketch/4.svg')}}" alt="">
                </div>
                <div class="col align-self-center" data-aos="fade-left" data-aos-delay="500">
                    <h1 class="mb-4 mr-2 text-dark">
                        Atur <b class="text-primary">Kreasi</b> sesukamu!
                    </h1>
                    <p class="mb-4 mr-2">
                        Kamu dapat meng-upload kreasi - kreasi kamu sesuai dengan bidang yang kamu tekuni,
                        kreasi
                        kamu akan di tautkan dengan akun kamu sebagai karya dan portofolio.
                    </p>
                    <a class="btn btn-lg btn-outline-primary" href="{{ url('creation') }}" role="button">Lihat
                        Kreasi</a>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
{{-- KREASI TERBARU --}}
<section class="section">
    <div class="container">
        <div class="section-body">
            <div class="row">
                <div class="col align-self-center text-center">
                    <h3 class="my-4 text-dark font-weight-bold" data-aos="zoom-out" data-aos-delay="400">
                        Kreasi Bangsa menyediakan tempat untuk menuang <b class="text-primary">Karya</b>
                    </h3>
                    <blockquote class="blockquote" data-aos="fade-up" data-aos-delay="600">
                        <p class="mb-0">Creativity is intelligence having fun</p>
                        <footer class="blockquote-footer"><cite title="Source Title">Albert Einstein</cite></footer>
                    </blockquote>
                    <a class="btn btn-lg btn-outline-primary mt-4" data-aos="zoom-out" data-aos-delay="800"
                        href="{{ url('register') }}" role="button">Bergabung
                        Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection