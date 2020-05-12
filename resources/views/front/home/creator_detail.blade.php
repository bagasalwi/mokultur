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
                    @foreach ($post as $p)
                    <div class="col-md-12">
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
                                    <h2><a href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a></h2>
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