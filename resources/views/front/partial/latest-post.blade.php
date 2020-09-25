<div class="col-lg-6">
    <h6 class="text-dark">Latest Post</h6>
    <div id="posts">
        @foreach ($creation as $p)
        <div class="card border-0 my-4">
            <img class="img-fluid img-imagepost" src="{{ asset('storage/' . $p->photo()) }}" alt="">
            <div class="my-2">
                <h2><a class="text-dark" href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a></h2>
            </div>
            <div class="row">
                <div class="col-6 d-flex flex-row">
                    <div class="align-self-center mr-2">
                        <img alt="image" width="45" height="45"
                            src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                            class="rounded-circle">
                    </div>
                    <div class="align-self-center">
                        <h6 class="p-0 m-0">
                            <a class="text-dark"
                                href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a>
                        </h6>
                        <p class="p-0 m-1">
                            <span class="badge badge-dark">{{ $p->category->name }}</span>
                        </p>
                    </div>
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    <div class="align-self-end">
                        <a href="{{ url('creation/' . $p->slug) }}" class="btn btn-outline-dark ">Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    {!! $creation->render() !!}
    <div class="text-center">
        @if ($creation->hasMorePages())
        <button id="see-more" class="btn btn-block btn-dark" data-page="2" data-link="{{ url('/'.request()->segment(count(request()->segments())).'?page=') }}"
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
            $div.append($html);
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
</script>
@endsection