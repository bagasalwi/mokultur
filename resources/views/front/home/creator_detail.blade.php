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
            <div class="col-md-4 col-sm-12">
                @include('layouts.side-profile')
            </div>
            <div class="col-md-8 col-sm-12">
                @if ($post[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                    <p class="lead">
                        {{ $user->name }} belum mengupload kreasi / post saat ini
                    </p>
                </div>
                @else
                <div class="row">
                    @foreach ($post as $p)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <a href="{{ url('creation/' . $p->slug) }}">
                                    <h5>{{ $p->title }}</h5>
                                </a>
                            </div>
                            <img class="w-100 img-fluid" style="max-width: 100%; height: auto; "
                                src="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}" alt="">
                            <div class="card-body border-top">
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
                @endif
            </div>
        </div>
    </div>
</section>

@endsection