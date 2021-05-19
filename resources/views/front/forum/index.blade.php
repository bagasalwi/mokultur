@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Forums!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    See who behind the mask under those cool Article & Reviews? Explore!
                </p>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="card card-body border-0 bd-radius-8 shadow">
            <div class="d-flex flex-row">
                <div class="mr-auto">
                    <ul class="nav nav-pills" id="post-bar" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('post') ? 'active' : '' }}"
                                href="{{ route('post.index') }}">
                                My Article
                            </a>
                            <a class="nav-link {{ request()->is('review') ? 'active' : '' }}"
                                href="{{ route('review.index') }}">
                                My Review
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ml-auto">
                    <button type="button" data-toggle="modal" data-target="#articleType"
                        class="btn btn-primary px-4">Buat Catcher!</button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @foreach ($forum as $item)
            <div class="col-12">
                <div class="card card-body border-0 bd-radius-8 shadow">
                    <div class="d-flex flex-row">
                        <a class="text-dark"
                            href="#">
                            <h5>{{ $item->title }}</h5>
                        </a>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <p>Created by {{ $item->user()->first()->name }} at 
                                {{ $item->created_at->format('d M Y') }}
                            </p>
                        </div>
                        <div class="ml-auto px-2">
                            <a href="{{ route('forum.detail', $item->slug) }}"
                                class="btn btn-outline-dark btn-sm px-4">View</a>
                            <button onclick="deletePost({{ $item->id }})"
                                class="btn btn-outline-danger btn-sm px-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</section>

@endsection