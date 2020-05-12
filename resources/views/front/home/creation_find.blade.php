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
            <div class="col-lg-12 mt-4">
                <h4 class="text-primary">Kreasi yang serupa dengan " {{ $search }} "</h4>
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
                                        <a href="#">{{ $p->user->name }}</a>
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