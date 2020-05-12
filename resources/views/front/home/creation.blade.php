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
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-4">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <h2 class="text-primary font-weight-bold text-center mb-4">Cari Kreasi</h2>
                                <form action="{{ url('creation/search') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari Kreasi kesukaan mu!">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($best_post)
                    <div class="col-lg-8">
                        <div class="owl-carousel owl-theme slider" id="slider2">
                            <div><img alt="image" height="400" width="250" src="{{ URL::asset('gambar/user_post/' . $best_post->thumbnail) }}">
                                <div class="slider-caption">
                                    <a href="{{ url('creation/' . $best_post->slug) }}" class="hope">
                                        <div class="slider-title">
                                            <h4>{{ $best_post->title }}</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4">
                        @foreach ($post_latest as $pl)
                        <div class="my-4">
                            <div class="row">
                                <div class="col-8">
                                    <h6><a href="{{ url('creation/' . $pl->slug) }}"
                                            class="text-dark">{{ $pl->title }}</a>
                                    </h6>
                                    <a href="{{ url('creator/' . $pl->user->username) }}" class="text-primary">{{ $pl->user->name }}</a>
                                    <div class="bullet"></div>
                                    <a>{{ $pl->category->name }}</a>
                                </div>
                                <div class="col-4"><img class="float-right rounded" width="70" height="50"
                                        src="{{ URL::asset('gambar/user_post/' . $pl->thumbnail) }}" alt=""></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <h4 class="text-primary">Kreasi Popular</h4>
                <hr>
                <div class="row">
                    @foreach ($popular_post as $p)
                    <div class="col-lg-4 col-sm-12">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image"
                                    data-background="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a>{{ $p->category->name }}</a>
                                    <div class="bullet"></div> <a>{{ $p->created_at->diffForHumans() }}</a>
                                </div>
                                <div class="article-title">
                                    <a href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a>
                                </div>

                            </div>
                            <div class="article-user m-4">
                                <div class="article-user-details">
                                    <img alt="image" width="15" height="45"
                                        src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                                        class="rounded-circle mr-2">
                                    <div class="user-detail-name">
                                        <a href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a>
                                    </div>
                                    @if ($p->user->instagram != null)
                                    <div class="text-job">{{ '@'.$p->user->instagram }}</div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <h4 class="text-primary">Kreasi Terakhir</h4>
                <hr>
                <div class="row" id="load-data">
                    @foreach ($post as $p)
                    <div class="col-lg-4 col-sm-12">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image"
                                    data-background="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a>{{ $p->category->name }}</a>
                                    <div class="bullet"></div> <a>{{ $p->created_at->diffForHumans() }}</a>
                                </div>
                                <div class="article-title">
                                    <a href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a>
                                </div>

                            </div>
                            <div class="article-user m-4">
                                <div class="article-user-details">
                                    <img alt="image" width="15" height="45"
                                        src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                                        class="rounded-circle mr-2">
                                    <div class="user-detail-name">
                                        <a href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a>
                                    </div>
                                    <div class="text-job">{{ '@'.$p->user->username }}</div>
                                </div>

                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                {{ $post->links() }}
            </div>
        </div>
    </div>
</div>
@endsection