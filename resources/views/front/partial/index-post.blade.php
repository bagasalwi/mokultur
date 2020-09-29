<div class="col-lg-9">
    <div id="posts">
        @foreach ($creation as $p)
        <div class="card border-0 my-4">
            <img class="img-cover my-2" data-max-height="200" data-max-width="auto" src="{{ asset('storage/' . $p->photo()) }}" alt="">
            <h2><a class="text-dark font-weight-bold" href="{{ url('creation/' . $p->slug) }}">{{ $p->title }}</a></h2>
            <div class="text-secondary no-pm text-preview" data-font-size="14px">
                {!! strlen($p->description) > 100 ? substr($p->description, 0, 150) . '...' : $p->description !!}
            </div>
            <div class="row">
                <div class="col-6 d-flex flex-row">
                    <div class="align-items-end">
                        <p class="text-secondary" data-font-size="12px">
                            {{ Carbon\Carbon::parse($p->date_published)->diffForHumans() }} &middot; <a
                                href="{{ url('creator/' . $p->user->username) }}">{{ strtoupper($p->user->name) }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    <div class="align-self-end">
                        <a href="{{ url('creation/' . $p->slug) }}" class="btn btn-outline-dark m-0">Read
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
        <button id="see-more" class="btn btn-block btn-dark" data-page="2" data-link="{{ url('/?page=') }}"
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