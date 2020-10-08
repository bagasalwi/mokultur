@extends('front.layouts.master')

@section('content')
{{-- <div class="jumbotron jumbotron-fluid" style="background-color:#ff6ca9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="text-white font-weight-bold text-center mb-4">Cari Kreator</h2>
                <form action="{{ url('creator/search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search"
                            placeholder="Cari kreator Favoritmu!">
                        <div class="input-group-append">
                            <button class="btn btn-light"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="my-4">
        <p class="no-pm">Showing result for :</p>
        <form action="{{ route('post') }}" role="search">
            <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                value="{{ isset($search_meta ) ? $search_meta : ""  }}">
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="row">
                @foreach ($creator as $cr)
                @if ($cr->latestPost != null)
                <div class="col-md-4">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="media">
                                <figure class="avatar avatar-lg mr-3">
                                    <img src="{{ URL::asset('gambar/profile_pic/' . $cr->profile_pic) }}" alt="...">
                                </figure>
                                <div class="media-body">
                                    @php
                                    if (strlen($cr->name) > 12){
                                    $name = substr($cr->name, 0, 12) . '...';
                                    }else{
                                    $name = $cr->username;
                                    }
                                    @endphp
                                    <h4 class="mt-0 text-primary"><a class="stretched-link" href="{{ url('creator/' . $cr->username) }}">{{ $name }}</a></h4>
                                    <p class="font-weight-light text-gray">{{ '@' . $cr->username }}</p>
                                </div>
                            </div>
                            <img class="rounded w-100 img-fluid" style="height: 200px;"
                                    src="{{ URL::asset('gambar/user_post/' . $cr->latestPost->thumbnail) }}" alt="">
                            <div class="mt-2">
                                <a><i class="fas fa-eye"></i> {{ $cr->latestPost->view_count }}</a>
                                <div class="bullet"></div>
                                <a>{{ $cr->latestPost->category->name }}</a>
                                <a class="float-right">{{ $cr->latestPost->created_at->format('d M Y') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            {{ $creator->links() }}
        </div>
    </div>
</div>
@endsection