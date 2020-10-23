<div class="col-lg-6 col-sm-12">
    <h3 class="text-dark font-weight-bold">Latest Post</h3>
    <hr>
    <div id="posts" class="row">
        @foreach ($creation as $p)
        <div class="col-lg-12 col-sm-12">
            <a href="{{ route('post.detail',$p->slug) }}" class="card-block clearfix">
                <div class="card border-0 my-2">
                    <div class="card-img-wrap">
                        <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}" alt="">
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
        <hr>
        @endforeach
    </div>
    {!! $creation->render() !!}
    <div class="text-center my-4">
        @if ($creation->hasMorePages())
        <button id="see-more" class="btn btn-block btn-dark" data-page="2" data-link="{{ url()->current().'?page=' }}"
            data-div="#posts">See more</button>
        @else
        <h6 class="text-secondary font-weight-normal">No More Data</h6>
        @endif
    </div>
</div>


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