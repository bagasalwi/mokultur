@extends('front.layouts.master')

@section('content')

@include('front.creator.creator-hero')

@php
$fullname = $user->name;
$fullname = trim($fullname); // remove double space
$firstname = substr($fullname, 0, strpos($fullname, ' '));
$lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
@endphp

<section class="mini-section">
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
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <a href="{{ route('review.detail',$p->slug) }}" class="card-block clearfix">
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
                                    href="{{ route('review.detail',$p->slug) }}">{{ $p->title }}</a></h5>
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
                    {!! $review->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection