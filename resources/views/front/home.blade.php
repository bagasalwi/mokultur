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
                    <span style="color: #FF549C;">
                        <i class="fas fa-palette fa-4x"></i>
                        <h4 class="text-primary mt-4">KARYA</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="400">
                    <span style="color: #FF549C;">
                        <i class="fas fa-trophy fa-4x"></i>
                        <h4 class="text-primary mt-4">PORTOFOLIO</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="600">
                    <span style="color: #FF549C;">
                        <i class="fas fa-award fa-4x"></i>
                        <h4 class="text-primary mt-4">BERSAING</h4>
                    </span>
                </div>
                <div class="col-lg-3 col-sm-3 mt-4" data-aos="zoom-in" data-aos-delay="800">
                    <span style="color: #FF549C;">
                        <i class="fas fa-photo-video fa-4x"></i>
                        <h4 class="text-primary mt-4">MEDIA</h4>
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
<section class="section" style="background-color:#FF549C;">
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
                @foreach ($post_latest as $pl)
                <div class="col-12 col-md-4 col-lg-4" data-aos="zoom-out-up">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image"
                                data-background="{{ URL::asset('gambar/user_post/' . $pl->thumbnail) }}">
                            </div>
                        </div>
                        <div class="article-details">
                            <h6><a href="{{ url('creation/' . $pl->slug) }}">{{ $pl->title }}</a></h6>
                            <div class="article-title">
                            </div>
                            <div class="article-user">
                                <img alt="image" width="30" height="45"
                                    src="{{ URL::asset('gambar/profile_pic/' . $pl->user->profile_pic) }}">
                                <div class="article-user-details">
                                    <div class="user-detail-name">
                                        <a href="{{ url('creator/' . $pl->user->username) }}">{{ $pl->user->name }}</a>
                                    </div>
                                    <div class="text-job">{{ '@'.$pl->user->username }}</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
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