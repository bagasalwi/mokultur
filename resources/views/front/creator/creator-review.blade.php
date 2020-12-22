@extends('front.layouts.master')

@section('content')

@include('front.creator.creator-hero')

@php
$fullname = $user->name;
$fullname = trim($fullname); // remove double space
$firstname = substr($fullname, 0, strpos($fullname, ' '));
$lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
@endphp

<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @include('front.creator.creator-nav')
                @if ($review[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                    <p class="lead">
                        {{ $user->name }} belum mengupload Review saat ini
                    </p>
                </div>
                @else
                <div id="reviews" class="row">
                    @foreach ($review as $p)
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
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
                                            <span>Score</span>
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
                                    <hr>
                                    <small class="text-secondary no-pm">
                                        {{ Carbon\Carbon::parse($p->created_at)->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {!! $review->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection