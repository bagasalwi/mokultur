@extends('front.layouts.master')

@section('meta_title')Browse Review @endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-4 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Review's Room!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Browse published reviews within all creators right here, Explore!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="card card-body border-0 bd-radius-4 shadow-sm mb-4">
                    <p class="no-pm">{{ isset($search_meta ) ? 'Showing result for :' : 'Search a Review :'  }}</p>
                    <form action="{{ route('review') }}" role="search">
                        <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                            value="{{ isset($search_meta ) ? $search_meta : ""  }}">
                    </form>
                </div>
                @include('front.layouts.review-card', ['col' => '4'])
                {!! $review->render() !!}
                <div class="text-center mt-4">
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