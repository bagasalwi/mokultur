@extends('front.layouts.master')

@section('content')
<div class="section">
    <div class="container">
        <div id="lmao"></div>
        <div class="my-4">
            <p class="no-pm">Showing result for :</p>
            <form action="{{ route('post') }}" role="search">
                <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.." value="{{ isset($search_meta ) ? $search_meta : ""  }}">
            </form>
        </div>
        <div class="row">
            <div class="col-lg-9 post-index">
                <div id="posts">
                    @foreach ($creation as $p)
                    <div class="card border-0 my-4">
                        <img class="img-cover img-index my-2"
                            src="{{ asset('storage/' . $p->photo()) }}" alt="">
                        <h2><a class="text-dark font-weight-bold"
                                href="{{ route('post.detail',$p->slug) }}">{{ $p->title }}</a></h2>
                        <div class="text-secondary no-pm text-preview">
                            {!! strlen($p->description) > 100 ? substr($p->description, 0, 150) . '...' :
                            $p->description
                            !!}
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex flex-row">
                                <div class="align-items-end">
                                    <p class="text-secondary" data-font-size="12px">
                                        {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse">
                                <div class="align-self-end">
                                    <a href="{{ route('post.detail',$p->slug) }}" class="btn btn-outline-dark m-0">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="float-right">
                        {!! $creation->render() !!}
                    </div>
                </div>
            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection