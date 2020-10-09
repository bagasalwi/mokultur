@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <div class="card card-body border-0">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center">
                                <img class="rounded-circle" width="150" height="150"
                                    src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex flex-column align-self-center">
                            <h1>{{ $user->name }}</h1>
                            <p class="text-secondary">{{ $user->description }}</p>
                            <div class="flex-row">
                                @if ($user->facebook)
                                <button class="btn btn-facebook"
                                    onclick="location.href='https://facebook.com/{{ $user->facebook }}';">
                                    <i class="fab fa-facebook"></i> Facebook
                                </button>
                                @endif
                                @if($user->instagram)
                                <button class="btn btn-instagram"
                                    onclick="location.href='https://instagram.com/{{ $user->instagram }}';">
                                    <i class="fab fa-instagram"></i> Instagram
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">All Post <span
                                class="badge badge-dark px-2 ml-2">{{ $post_count }}</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if ($post[0] == null)
                        <div class="empty-state" data-height="400">
                            <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                            <h2>Tidak ada Post</h2>
                            <p class="lead">
                                {{ $user->name }} belum mengupload kreasi / post saat ini
                            </p>
                        </div>
                        @else
                        <div id="posts" class="row">
                            @foreach ($post as $p)
                            <div class="col-lg-6 col-sm-12">
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