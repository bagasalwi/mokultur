@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="mb-2">
            <h2 class="no-pm">My Activities</h2>
            <small class="no-pm text-secondary">Your Account active since {{ auth()->user()->created_at->format('M Y') }}</small>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex justify-content-center">
                                <img class="rounded-circle" width="150" height="150"
                                    src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                            </div>
                        </div>
                        <div class="col-md-9 d-flex flex-column align-self-center">
                            <h1>{{ $greetings }}, {{ $user->name }} !</h1>
                            <p class="text-secondary">{{ $user->description }}</p>
                            <div class="flex-row">
                               <a class="btn btn-outline-dark" href="{{ route('post.index') }}">Manage My Post</a>
                               <a class="btn btn-dark" href="{{ route('profile') }}">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 my-4">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item mr-2">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">My Post</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link" id="fact-tab" data-toggle="tab" href="#fact" role="tab"
                            aria-controls="home" aria-selected="true">Facts About My Account</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if ($post[0] == null)
                        <div class="empty-state" data-height="400">
                            <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                            <h2>Tidak ada Post</h2>
                        </div>
                        @else
                        <div id="posts" class="row">
                            @foreach ($post as $p)
                            <div class="col-lg-4 col-sm-12">
                                <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                                    <div class="card border-0 my-2">
                                        <div class="card-img-wrap">
                                            <img class="img-fluid img-imagepost"
                                                src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                            <div class="card-img-overlay text-white">
                                                <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <h4 class="no-pm">
                                                <a href="{{ route('post.detail',$p->slug) }}">{{ $p->title }}</a>
                                            </h4>
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
                                data-link="{{ url()->current().'?page=' }}" data-div="#posts">See more</button>
                            @else
                            <h6 class="text-secondary font-weight-normal">No More Data</h6>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="fact" role="tabpanel" aria-labelledby="fact-tab">
                        <div class="row">
                            <div class="col-3">
                                <div class="card card-body bg-dark">
                                    <h5 class="text-white">Here Just to Post</h5>
                                    <p class="text-white">Overall Total Post, {{ $total_post }} Article</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card card-body bg-dark">
                                    <h5 class="text-white">My Viewers, My Achievement</h5>
                                    <p class="text-white">Total Views from All Post, {{ $total_view }}</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card card-body bg-dark">
                                    <h5 class="text-white">From The Beginning</h5>
                                    <p class="text-white">Your Account active since {{ $active_since }}</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card card-body bg-dark">
                                    <h5 class="text-white">The Tag Master</h5>
                                    <p class="text-white"></p>
                                </div>
                            </div>
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
                $('#see-more').replaceWith('<h6 class="text-secondary font-weight-normal">No More Data</h6>')          
            }else{
                $div.append($html);
            }
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });    
</script>
@endsection