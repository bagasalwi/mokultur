@extends('front.layouts.master')

@section('content')
@include('front.profile.dashboard-hero')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 my-4">
                @include('front.profile.dashboard-nav')
                <hr>
                @if ($post[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Article</h2>
                    <a href="{{ route('post') }}" class="btn btn-primary">Buat Artikel</a>
                </div>
                @else
                <div id="posts" class="row">
                    @foreach ($post as $p)
                    <div class="col-lg-4 col-sm-12">
                        <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 my-2">
                                <div class="card-img-wrap bd-radius-4">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}"
                                        alt="">
                                    {{-- <div class="card-img-overlay text-white">
                                        <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                    </div> --}}
                                </div>
                                <div class="mt-1">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}">
                                        <h4 class="no-pm">{{ $p->title }}</h4>
                                    </a>
                                </div>
                                <small class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                    {{ $p->user->name }}
                                </small>
                            </div>
                        </a>

                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @if ($post->hasMorePages())
                    {!! $post->render() !!}
                    @else
                    <h6 class="text-secondary">No More Data</h6>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection