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
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h2 class="text-primary font-weight-bold text-center mb-4">Cari Kreator</h2>
                        <form action="{{ url('creator/search') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="row">
                    @foreach ($creator as $cr)
                    @if ($cr->latestPost != null)
                    <div class="col-md-4">
                        <div class="card">
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
                                        <h4 class="mt-0 text-primary"><a href="{{ url('creator/' . $cr->username) }}">{{ $name }}</a></h4>
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
</div>

@endsection