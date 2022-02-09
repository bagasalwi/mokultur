<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        @guest
        <div class="card card-full bd-radius-4 mb-4">
            <div id="load_review" class="card-body">
                
            </div>
        </div>
        @else
        <div class="card card-full bd-radius-4 mb-2">
            <div class="card-body">
                <h6 class="text-primary no-pm">HELLO,
                    <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                </h6>
                <p class="text-dark">You can create a post now, share your stories with others!</p>
                <a href="{{ route('post.index') }}" class="btn btn-sm btn-block btn-dark">Start make Post</a>
            </div>
        </div>
        @endguest
        <div class="card card-full bd-radius-4 mb-2">
            <div class="card-body">
                <h6 class="my-1 bolder-text">FOLLOW <span class="text-primary fw-600">OUR INSTAGRAM</span></h6>
                <div class="my-3" id="instagram" style="max-width: 200px; margin: 0 auto;"></div>
                <a href="https://www.instagram.com/mokultur/" class="btn btn-sm btn-block btn-outline-primary">FOLLOW US</a>
            </div>
        </div>

        <a class="btn btn-white btn-block mb-2 text-white card-hover" href="https://trakteer.id/mokultur" style="background-color: #D02532" target="_blank">
            <img height="25" width="25" src="{{ asset('gambar/icon/trakteer.svg') }}" alt=""> Traktir Moku Kopi
        </a>
    </div>
</div>

@push('script')
<script>    
    $.get("{{ route('review.load_data') }}",function(data) {
            $("#load_review").html(data);
        }
    );
</script>
@endpush