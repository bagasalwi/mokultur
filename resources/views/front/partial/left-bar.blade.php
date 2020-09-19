<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        @guest
        <div class="card card-full mb-4" data-background-full="{{ asset('gambar/bg-1.jpg') }}">
            <div class="card-body">
                <h4 class="text-dark">Sign In to make a Post</h4>
                <p class="text-dark">While you sign in to your account, you can share your stories through
                    My Post.</p>
            </div>
        </div>
        @else
        <div class="card card-full mb-4" data-background-full="{{ asset('gambar/bg-1.jpg') }}">
            <div class="card-body">
                <h6 class="text-dark">Welcome,
                    <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                </h6>
                <p class="text-dark">You can create a post now, share your stories with others!</p>
                <a href="#" class="btn btn-sm btn-block btn-dark">Start make Post</a>
            </div>
        </div>
        @endguest
        <div class="card card-full mb-4" data-background-full="{{ asset('gambar/instagram.jpg') }}">
            <div class="card-body">
                <h5 class="text-white text-center">
                    Check our Instagram
                </h5>
                <div class="text-center">
                    <img src="{{ asset('gambar/instagram-logo.png') }}" width="80" height="80"
                        class="my-2" alt="">
                </div>
                <p data-font-size="12px" class="text-white">Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI
                    Design,
                    Illustration, Reviews and more.</p>
                <a href="#" class="btn btn-sm btn-block btn-outline-light">Follow</a>
            </div>
        </div>
    </div>
</div>