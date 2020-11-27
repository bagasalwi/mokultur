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
                @if ($post[0] == null)
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                    <p class="lead">
                        {{ $user->name }} Belum Mengupload Article Saat Ini
                    </p>
                </div>
                @else
                <div id="posts" class="row">
                    @foreach ($post as $p)
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card border-0 my-2">
                                <div class="card-img-wrap bd-radius-8">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}"
                                        alt="">
                                    <div class="card-img-overlay text-white">
                                        <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('post.detail',$p->slug) }}">
                                        <h4 class="no-pm">{{ $p->title }}</h4>
                                    </a>
                                </div>
                                <small class="text-secondary">
                                    {{ Carbon\Carbon::parse($p->date_published)->format('d M Y') }} &middot;
                                    {{ $p->user->name }}
                                </small>
                            </div>
                        </a>

                    </div>
                    @endforeach
                </div>
                {!! $post->render() !!}
                <div class="text-center">
                    @if ($post->hasMorePages())
                    <button id="see-more" class="btn btn-block btn-dark" data-page="2"
                        data-link="{{ url()->current().'?page=' }}" data-div="#posts">Reach More</button>
                    @else
                    <h4 class="text-secondary font-weight-normal">You reach the bottom of Knowledge!</h4>
                    @endif
                </div>
                @endif

                <div class="row">
                    <div class="col-auto">
                        <div class="card card-body bg-dark bd-radius-8">
                            <h5 class="text-white">Here Just to Post</h5>
                            <p class="text-white">Overall Total Post, {{ $total_post }} Article</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card card-body bg-dark bd-radius-8">
                            <h5 class="text-white">My Viewers, My Achievement</h5>
                            <p class="text-white">Total Views from All Post, {{ $total_view }}</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card card-body bg-dark bd-radius-8">
                            <h5 class="text-white">From The Beginning</h5>
                            <p class="text-white">Your Account active since {{ $active_since }}</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card card-body bg-dark bd-radius-8">
                            <h5 class="text-white">The Tag Master</h5>
                            <p class="text-white"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $("ul.pagination").hide();

    $("#see-more").click(function() {
        $div = $($(this).data('div')); //div to append
        $link = $(this).data('link'); //current URL

        $page = $(this).data('page'); //get the next page #
        $href = $link + $page; //complete URL
        $.get($href, function(response) { //append data
            $html = $(response).find("#posts").html(); 
            if($html.length < 20){
                $('#see-more').replaceWith('<h6 class="text-secondary font-weight-normal">You reach the bottom of Knowledge!!</h6>')          
            }else{
                $div.append($html);
            }
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });    
</script>
@endsection