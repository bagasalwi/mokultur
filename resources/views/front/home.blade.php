@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid bg-front mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-none d-sm-block d-sm-block">
                <div class="card card-body shadow rounded">
                    <img class="img-responsive align-self-center" src="{{ asset('gambar/mock-1.png') }}" alt=""
                        data-max-width="250px">
                    <h5 class="text-dark">Join Us and Start Sharing Your Creations</h5>
                    <p data-font-size="14px" class="font-weight-normal">
                        You can upload your creations from hobby, works, portofolio and sharing with others.
                    </p>
                    <div class="mt-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-block">Join with us</a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">I already have an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 align-self-center">
                <h1 class="text-dark font-weight-bold">Upload Your Creation!</h1>
                <p class="mb-4 text-dark" data-font-size="16px">
                    Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI Design, Illustration, Reviews and
                    more.
                </p>
                <a class="btn btn-dark btn-lg font-weight-bold" href="{{ url('creation') }}" role="button">Browse
                    Creation</a>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="stickydiv">
                    <div class="card card-full" data-background="{{ asset('gambar/bg-1.jpg') }}">
                        <div class="card-body">
                            <h4 class="text-dark">Welcome, Bagas</h4>
                            <p class="text-dark">Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI Design,
                                Illustration, Reviews and more.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="text-dark">Popular Creation</h5>
                @foreach ($creation as $p)
                <div class="card border-0 my-2">
                    <img class="img-fluid img-imagepost" style="object-fit: cover;"
                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                    <div class="my-2">
                        <h2><a class="text-dark" href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a></h2>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex flex-row">
                            <div class="align-self-center mr-2">
                                <img alt="image" width="45" height="45"
                                    src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                                    class="rounded-circle">
                            </div>
                            <div class="align-self-center">
                                <h6 class="p-0 m-0">
                                    <a class="text-dark"
                                        href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a>
                                </h6>
                                <p class="p-0 m-0"><span class="badge badge-dark">{{ $p->category->name }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-6 d-flex flex-row-reverse">
                            <div class="align-self-end">
                                <a href="{{ url('creation/' . $p->slug) }}" class="btn btn-outline-dark ">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            <div class="col-lg-3">
                <div class="stickydiv">
                    <div class="card card-full" data-background-full="{{ asset('gambar/covid.jpg') }}">
                        <div class="card-body">
                            <h4 class="text-dark">Wear your mask, Always!</h4>
                            <p class="text-dark">due to covid19, you have to stick your mask as always as possible.</p>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-dark">Top Categories</h5>
                    <div class="list-group">
                        @foreach ($category as $category)
                        <a href="#" class="list-group-item list-group-item-action">
                            <h4 class="text-dark">{{ $category->name }}</h4>
                            <small class="text-muted">{{ $category->description }}</small>
                        </a>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KREASI TERBARU --}}
{{-- <section class="section" style="background-color:#ff6ca9;">
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
    <img class="embed-responsive-item img-fluid" src="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}" alt="">
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
    <a class="btn btn-lg btn-light mt-4" data-aos="zoom-out" data-aos-delay="600" href="{{ url('creation') }}"
        role="button">Lihat Selengkapnya</a>
</div>
</div>
</div>
</section> --}}

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