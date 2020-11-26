@extends('front.layouts.master')

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
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div id="reviews" class="row">
                    @foreach ($review as $p)
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <a href="{{ route('review.detail',$p->slug) }}" class="card-block clearfix">
                            <div class="card border-0 mb-2">
                                <div class="card-img-wrap mb-2 bd-radius-4">
                                    <img class="img-fluid img-imagereview" loading="lazy"
                                        src="{{ asset('storage/' . $p->photo()) }}" alt="">
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
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                {!! $review->render() !!}
                <div class="text-center">
                    @if ($review->hasMorePages())
                    <button id="see-more" class="btn btn-block btn-dark" data-page="2"
                        data-link="{{ url()->current().'?page=' }}" data-div="#reviews">See more</button>
                    @else
                    <h6 class="text-secondary">You reach the bottom of Review!</h6>
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
            $html = $(response).find("#reviews").html(); 
            if($html.length < 40){
                // alert('habis');
                $('#see-more').replaceWith('<h6 class="text-secondary font-weight-normal">You reach the bottom of Review!</h6>')          
            }else{
                // alert($html);
                $div.append($html);
            }
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
</script>
@endsection