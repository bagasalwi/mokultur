<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        @guest
        <div class="card card-full bd-radius-4 mb-4">
            <div id="load_review" class="card-body">
                
            </div>
        </div>
        @else
        <div class="card card-full bd-radius-4 mb-4">
            <div class="card-body">
                <h6 class="text-primary no-pm">Hello,
                    <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                </h6>
                <p class="text-dark">You can create a post now, share your stories with others!</p>
                <a href="{{ route('post.index') }}" class="btn btn-sm btn-block btn-dark">Start make Post</a>
            </div>
        </div>
        @endguest
        <div class="card card-full bd-radius-4 mb-4">
            <div class="card-body">
                <h6 class="my-1 fw-800">FOLLOW <span class="text-primary fw-800">OUR INSTAGRAM</span></h6>
                <div class="my-3" id="instagram" style="max-width: 200px; margin: 0 auto;"></div>
                <a href="https://www.instagram.com/mokultur/" class="btn btn-sm btn-block btn-dark">Follow @mokultur</a>
            </div>
        </div>
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