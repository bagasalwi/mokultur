@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        @include('front.profile.dashboard-hero')
        <div class="row">
            <div class="col-md-12 col-sm-12 my-4">
                @include('front.profile.dashboard-nav')
                <hr>
                @if ($review[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Review</h2>
                    <a href="{{ route('review') }}" class="btn btn-primary">Buat Review</a>
                </div>
                @else
                <div id="reviews" class="row">
                    @foreach ($review as $p)
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card-img-wrap mb-2 bd-radius-4 my-2">
                                <img class="img-fluid img-imagereview" loading="lazy"
                                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                <div class="card-img-overlay">
                                    <?php
                                        if($p->score < 7 && $p->score > 5){
                                            $score_color = 'warning';
                                        }elseif($p->score < 5){
                                            $score_color = 'danger';
                                        }else{
                                            $score_color = 'success';
                                        }   
                                        ?>
                                    <div class="badge badge-{{ $score_color }} align-self-center bd-radius-4 shadow">
                                        <span class="m-1">Score</span>
                                        <h6 class="no-pm">{{ $p->score }}/10</h6>
                                    </div>
                                </div>
                            </div>
                            <h5><a class="text-dark font-weight-bold"
                                    href="{{ route('review.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a></h5>
                            <div class="text-secondary no-pm">
                                {{ str_limit(strip_tags($p->content),70,'...') }}
                            </div>
                            <div class="align-items-end mt-2">
                                <p class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a
                                        href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->username) }}</a>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @if ($review->hasMorePages())
                        {!! $review->render() !!}
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