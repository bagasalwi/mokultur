@extends('front.layouts.master')

@section('css')
<style>
    body {
        background: url('{{ asset('storage/' . $category->banner) }}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
@endsection

@section('content')

<div class="section">
    <div class="container">
        <div class="jumbotron img-cover d-flex shadow" data-height="300" style="background-position: center;"
            data-background="https://2.bp.blogspot.com/-YSRL7xmCD2Q/XQ8eHaJ9wkI/AAAAAAAAHtA/0-bVcL3HJmQ4eCCCJY8Sq9y0tGKoVw3IwCKgBGAs/w0/genshin-impact-uhdpaper.com-4K-1.jpg">
            <div class="align-self-center">
                <h1 data-font-size="60px">Genshin Impact Tips & Trick</h1>
                <a href="#" class="btn btn-lg btn-dark">Browse Article</a>
            </div>
        </div>
        <div class="row">
            {{-- Latest Post --}}
            <div class="col-lg-9 col-sm-12">
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-lg-12 col-sm-12">
                        <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card border-0 my-2 shadow-lg">
                                <div class="card-img-wrap">
                                    <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}"
                                        alt="">
                                    <div class="card-img-overlay text-white">
                                        <h5 class="badge badge-light shadow">{{ $p->category->name }}</h5>
                                    </div>
                                </div>
                                <div class="card-body">
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
                            </div>
                        </a>

                    </div>
                    <hr>
                    @endforeach
                </div>
                {!! $creation->render() !!}
                <div class="text-center">
                    @if ($creation->hasMorePages())
                    <button id="see-more" class="btn btn-block btn-dark" data-page="2"
                        data-link="{{ url()->current().'?page=' }}" data-div="#posts">See more</button>
                    @else
                    <h6 class="text-secondary font-weight-normal">No More Data</h6>
                    @endif
                </div>
            </div>
            {{-- Latest Post --}}

            {{-- Right Bar --}}
            <div class="col-lg-3 d-none d-lg-block">
                <div class="stickydiv">
                    <div class="card card-full border-0 no-bd-radius pattern-3">
                        <div class="card-overlay"></div>
                        <div class="card-body">
                            <h4 class="text-dark">Always wear Mask!</h4>
                            <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                            </p>
                        </div>
                    </div>
                    <hr>
                    <h4 class="text-white">Top Topic's</h4>
                    <div class="list-group">
                        @foreach ($topCategory as $category)
                        <div class="card card-hover border-0 no-bd-radius my-2"
                            data-background="{{ asset('storage/' . $category->banner) }}">
                            <div class="card-overlay"></div>
                            <div class="card-body d-flex">
                                <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}"
                                    style="text-decoration : none">
                                    <div class="align-self-center">
                                        <h2 class="text-white">{{ $category->name }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Right Bar --}}
        </div>
    </div>
</div>

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
            if($html.length < 40){
                $('#see-more').replaceWith('<h6 class="text-secondary font-weight-normal">No More Data</h6>')          
            }else{
                $div.append($html);
            }
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
</script>
@endsection