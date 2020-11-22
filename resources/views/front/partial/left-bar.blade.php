<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        @guest
        <div class="card card-full no-bd-radius mb-4">
            <div class="card-body">
                <h4 class="text-primary">Sign In to make a Post</h4>
                <p class="text-dark">While you sign in to your account, you can share your stories through
                    My Post.</p>
            </div>
        </div>
        @else
        <div class="card card-full mb-4">
            <div class="card-body">
                <h6 class="text-primary no-pm">Hello,
                    <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                </h6>
                <p class="text-dark">You can create a post now, share your stories with others!</p>
                <a href="{{ route('post.index') }}" class="btn btn-sm btn-block btn-dark">Start make Post</a>
            </div>
        </div>
        @endguest
        <div class="card card-full bd-radius-8 mb-4">
            <div class="card-body">
                <h4 class="my-1 text-primary">Follow Our Instagram</h4>
                <div class="my-3" id="instagram" style="max-width: 200px; margin: 0 auto;"></div>
                <a href="#" class="btn btn-sm btn-block btn-instagram">Follow</a>
            </div>
        </div>
    </div>
</div>