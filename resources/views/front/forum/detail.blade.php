@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">{{ $forum->title }}</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    {{ $forum->content }}
                </p>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-body border-0 bd-radius-4">
                <ul class="list-unstyled list-unstyled-border">
                    @foreach ($forum->comments as $item)
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" src="http://127.0.0.1:8000/avatar/8.png" width="50">
                        <div class="media-body">
                            <div class="mt-0 mb-1 font-weight-bold">{{ $item->user()->first()->name }}</div>
                            {{-- <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div> --}}
                            <p>{{ $item->text }}</p>
                        </div>
                    </li>
                    @endforeach
        
                    {{-- <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" src="assets/img/avatar/avatar-2.png" width="50">
                        <div class="media-body">
                            <div class="mt-0 mb-1 font-weight-bold">Bagus Dwi Cahya</div>
                            <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                    </li> --}}
                </ul>
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form">
                    <input type="text" class="form-control" placeholder="Type a message">
                    <button class="btn btn-sm btn-primary mt-2">
                        <i class="far fa-paper-plane"></i> Komentar
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</section>

@endsection