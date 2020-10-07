@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <div class="card my-2 sticky-top">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center">
                                <img class="rounded-circle my-2" width="150" height="150" 
                                    src="{{ URL::asset('gambar/profile_pic/' . $user->profile_pic) }}" alt="...">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex flex-column align-self-center">
                            <h2><a href="{{ url('creator/'. $user->username) }}">{{ $user->name }}</a></h2>
                            <p class="text-secondary">{{ $user->description }}</p>
                        </div>
                    </div>
                </div>
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
                    <div class="col-lg-6 col-sm-12">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card border-0 my-2">
                                <div class="card-img-wrap">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                    <div class="card-img-overlay text-white">
                                        <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <h4 class="no-pm">
                                        <a href="{{ route('post.detail',$p->slug) }}">{{ $p->title }}</a>
                                    </h4>
                                </div>
                                <small class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                    {{ $p->user->name }}
                                </small>
                            </div>
                        </a>
            
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