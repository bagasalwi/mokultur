@extends('front.layouts.master')

@section('meta_title')Browse Article @endsection

@section('content')
<div class="section">
    <div class="container">
        <div class="my-4">
            <p class="no-pm">{{ isset($search_meta ) ? 'Showing result for :' : 'Search an article :'  }}</p>
            <form action="{{ route('post') }}" role="search">
                <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                    value="{{ isset($search_meta ) ? $search_meta : ""  }}">
            </form>
        </div>
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <div id="posts" class="row">
                    @foreach ($creation as $p)
                    <div class="col-md-6">
                        <a href="{{ route('post.detail',[$p->user->username,$p->slug]) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagepost" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                </div>
                                <h4><a class="text-dark font-weight-bold"
                                        href="{{ route('post.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a></h4>
                                <div class="text-secondary no-pm">
                                    {{ str_limit(strip_tags($p->description),100,'...') }}
                                </div>
                                <div class="align-items-end mt-2">
                                    <p class="text-secondary">
                                        {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                            href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
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
                    <button id="see-more" class="btn btn-outline-dark" data-page="2"
                        data-link="{{ url()->current().'?page=' }}" data-div="#posts">See more</button>
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