@extends('front.layouts.master')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-12 offset-md-1">
                <article class="article article-style-c">
                    <div class="article-details">
                        <div class="article-title mb-3">
                            <h1 class="text-dark font-weight-boldness text-center">{{ $post->title }}</h1>
                        </div>
                        <div class="article-category mb-2">
                            <a>{{ $post->category->name }}</a>
                            <div class="bullet"></div>
                            <a><i class="fas fa-eye"></i> {{ $post->view_count }} Viewed</a>
                            <div class="bullet"></div>
                            <a>{{ $post->created_at->diffForHumans() }}</a>
                            <a class="float-right">{{ $post->created_at->format('d M Y') }}</a>
                            <div class="align-left">
                            </div>
                        </div>
                        <img src="{{ URL::asset('gambar/user_post/' . $post->thumbnail) }}" class="img-fluid w-100 mb-4">
                        {!! $post->description !!}
                        <div class="article-user mb-3">
                            <div class="article-user-details">
                                <img alt="image" width="15" height="45"
                                    src="{{ URL::asset('gambar/profile_pic/' . $post->user->profile_pic) }}"
                                    class="rounded-circle mr-2">
                                <div class="user-detail-name">
                                    <a href="{{ url('creator/' . $post->user->username) }}">{{ $post->user->name }}</a>
                                </div>
                                @if ($post->user->instagram != null)
                                <div class="text-job">{{ '@'.$post->user->instagram }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

@endsection