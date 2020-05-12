@extends('front.layouts.master')

@section('content')
<div class="main-content">
    <section class="section-top-front">
        <div class="container">
            <div class="section-body">
                <div class="row">
                    <div class="col d-none d-sm-block">
                        <img width="550" src="{{ URL::asset('gambar/sketch/1.svg')}}">
                    </div>
                    <div class="col align-self-center">
                        <h1 class="mb-4 mr-2 text-primary font-weight-bold">
                            Anak Muda Berkreasi !
                        </h1>
                        <p class="mb-4 mr-2">
                            Kreasi bangsa merupakan sarana untuk mengenalkan kreasi - kreasi anak bangsa, mulai dari
                            sketch,
                            UI hingga ilustrasi.
                        </p>
                        <a class="btn btn-lg btn-outline-primary" href="#" role="button">Mulai Berkarya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kenapa kreasi bangsa? --}}
    <section class="section">
        <div class="container">
            <div class="section-body">
                <div class="row text-center" data-aos="zoom-out">
                    <div class="col">
                        <span style="color: #FF549C;">
                            <i class="fas fa-palette fa-5x"></i>
                        </span>
                    </div>
                    <div class="col">
                        <span style="color: #FF549C;">
                            <i class="fas fa-trophy fa-5x"></i>
                        </span>
                    </div>
                    <div class="col">
                        <span style="color: #FF549C;">
                            <i class="fas fa-award fa-5x"></i>
                        </span>
                    </div>
                    <div class="col">
                        <span style="color: #FF549C;">
                            <i class="fas fa-photo-video fa-5x"></i>
                        </span>
                    </div>
                    <div class="w-100 mt-4"></div>
                    <div class="col" data-aos="zoom-in" data-aos-delay="400">
                        <h5 class="text-primary font-weight-normal">KARYA</h5>
                    </div>
                    <div class="col" data-aos="zoom-in" data-aos-delay="600">
                        <h5 class="text-primary font-weight-normal">PORTOFOLIO</h5>
                    </div>
                    <div class="col" data-aos="zoom-in" data-aos-delay="800">
                        <h5 class="text-primary font-weight-normal">BERSAING</h5>
                    </div>
                    <div class="col" data-aos="zoom-in" data-aos-delay="1000">
                        <h5 class="text-primary font-weight-normal">MEDIA</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sectionhr">
        <hr>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-body">
                <div class="row">
                    <div class="col align-self-center" data-aos="fade-up">
                        <h2 class="mb-4 mr-2 text-primary">
                            Buat Portofolio mu sekarang !
                        </h2>
                        <p class="mb-4 mr-2">
                            Kamu dapat meng-upload kreasi - kreasi kamu sesuai dengan bidang yang kamu tekuni,
                            kreasi
                            kamu akan di tautkan dengan akun kamu sebagai karya dan portofolio.
                        </p>
                        <a class="btn btn-lg btn-outline-primary" href="{{ url('creator') }}" role="button">Lihat Kreator</a>
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
                                <div class="article-image" data-background="{{ URL::asset('gambar/user_post/' . $pl->thumbnail) }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <h2><a href="{{ url('creation/' . $pl->slug) }}">{{ $pl->title }}</a></h2>
                                </div>
                                <div class="article-user">
                                    <img alt="image" width="30" height="45" src="{{ URL::asset('gambar/profile_pic/' . $pl->user->profile_pic) }}">
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
                        <h1 class="mb-4 mr-2 text-primary">
                            Atur Kreasi sesukamu!
                        </h1>
                        <p class="mb-4 mr-2">
                            Kamu dapat meng-upload kreasi - kreasi kamu sesuai dengan bidang yang kamu tekuni,
                            kreasi
                            kamu akan di tautkan dengan akun kamu sebagai karya dan portofolio.
                        </p>
                        <a class="btn btn-lg btn-outline-primary" href="{{ url('creation') }}" role="button">Lihat Kreasi</a>
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
                        <h4 class="my-4 text-primary font-weight-bold">
                            Kami menyediakan tempat untuk menuang Karya,
                        </h4>
                        <blockquote class="blockquote">
                            <p class="mb-0">Creativity is intelligence having fun</p>
                            <footer class="blockquote-footer"><cite title="Source Title">Albert Einstein</cite></footer>
                        </blockquote>
                        <a class="btn btn-lg btn-outline-primary mt-4" href="{{ url('register') }}" role="button">Bergabung Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection