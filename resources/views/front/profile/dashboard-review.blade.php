@extends('front.layouts.master')

@section('content')
@include('front.profile.dashboard-hero')
<section>
    <div class="container">
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
                    <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                        <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}"
                            class="card-block clearfix">
                            <div class="card border-0 shadow h-100">
                                <div class="card-img-wrap">
                                    <img class="card-img-top img-fluid img-imagereview" loading="lazy"
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
                                        <div class="badge badge-{{ $score_color }} align-self-center bd-radius-2">
                                            <h6 class="no-pm">{{ $p->score }}/10</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @php
                                    $tags = explode(',',$p->review_genre);   
                                    @endphp
                                    <div class="scrolling-wrapper-flexbox mb-2">
                                        <div class="badges">
                                            @foreach ($tags as $tag)
                                            <a href="#" class="badge badge-primary"
                                                value="{{$tag}}">{{$tag}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h6><a class="text-dark font-weight-bold"
                                            href="{{ route('review.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a>
                                    </h6>
                                    {{ str_limit(strip_tags($p->content),70,'...') }}
                                    <hr>
                                    <small class="text-secondary no-pm">
                                        {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }} &middot; <a href="{{ route('creator.detail', $p->user->username) }}">{{ '@'.strtoupper($p->user->username) }}</a>
                                    </small>
                                </div>
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