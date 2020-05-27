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
                    <div class="col-md-4 mb-4">
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
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                {{ $post->links() }}
            </div>
        </div>
    </div>
</section>
@endsection