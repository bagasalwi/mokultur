@extends('front.layouts.master')

@section('meta_title')Browse Article @endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Article's Room!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Browse published article within all creators right here, Explore!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <div class="card card-body border-0 bd-radius-4 shadow-sm mb-4">
                    <p class="no-pm">{{ isset($search_meta ) ? 'Showing result for :' : 'Search an article :'  }}</p>
                    <form action="{{ route('post') }}" role="search">
                        <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                            value="{{ isset($search_meta ) ? $search_meta : ""  }}">
                    </form>
                </div>
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-md-6">
                        <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagepost" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                </div>
                                <h5><a class="text-dark fw-700"
                                        href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}">{{ $p->title }}</a></h5>
                                <div class="text-secondary no-pm">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </div>
                                <div class="align-items-end mt-2">
                                    <p class="text-secondary">
                                        <small>
                                            {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ route('creator.detail', $p->user->username) }}">{{ '@'.$p->user->username }}</a>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                {!! $creation->render() !!}
                <div class="text-center my-2">
                    @if ($creation->hasMorePages())
                    <button id="see-more" class="btn btn-dark" data-page="2"
                        data-link="{{ url()->current().'?page=' }}" data-div="#posts">Jangkau Lebih Jauh..</button>
                    @else
                    <h6 class="text-secondary">You reach the bottom of Knowledge!</h6>
                    @endif
                </div>
            </div>
            @include('front.partial.right-bar')
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
                // alert('habis');
                $('#see-more').replaceWith('<h6 class="text-secondary">You reach the bottom of Knowledge!</h6>')          
            }else{
                // alert($html);
                $div.append($html);
            }
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
</script>
@endsection