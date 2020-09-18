@extends('front.layouts.master')

@section('content')
@guest
<div class="jumbotron jumbotron-fluid bg-front mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-none d-sm-block d-sm-block">
                <div class="card card-body shadow rounded">
                    <img class="img-responsive align-self-center" src="{{ asset('gambar/mock-1.png') }}" alt=""
                        data-max-width="250px">
                    <h5 class="text-dark">Join Us and Start Sharing Your Creations</h5>
                    <p data-font-size="14px" class="font-weight-normal">
                        You can upload your creations from hobby, works, portofolio and sharing with others.
                    </p>
                    <div class="mt-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-block">Join with us</a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">I already have an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 align-self-center">
                <h1 class="text-dark font-weight-bold">Upload Your Creation!</h1>
                <p class="mb-4 text-dark" data-font-size="16px">
                    Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI Design, Illustration, Reviews and
                    more.
                </p>
                <a class="btn btn-dark btn-lg font-weight-bold" href="{{ url('creation') }}" role="button">Browse
                    Creation</a>
            </div>
        </div>
    </div>
</div>
@endguest

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="stickydiv">
                    @guest
                    <div class="card card-full" data-background-full="{{ asset('gambar/bg-1.jpg') }}">
                        <div class="card-body">
                            <h4 class="text-dark">Sign In to make a Post</h4>
                            <p class="text-dark">While you sign in to your account, you can share your stories through
                                My Post.</p>
                        </div>
                    </div>
                    @else
                    <div class="card card-full" data-background-full="{{ asset('gambar/bg-1.jpg') }}">
                        <div class="card-body">
                            <h6 class="text-dark">Welcome,
                                <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                            </h6>
                            <p class="text-dark">Kreasibangsa introduce creations of Anak Bangsa like Sketch, UI Design,
                                Illustration, Reviews and more.</p>
                            <a href="#" class="btn btn-sm btn-block btn-dark">Start make Post</a>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="text-dark">Popular Creation</h5>
                <div id="posts">
                    @foreach ($creation as $p)
                    <div class="card border-0 my-2">
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
                                    <p class="p-0 m-0"><span class="badge badge-dark">{{ $p->category->name }}</span>
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
                    <button id="see-more" class="btn btn-block btn-dark" data-page="2" data-link="{{ url('/?page=') }}" data-div="#posts">See more</button> 
                </div>
            </div>
            <div class="col-lg-3">
                <div class="stickydiv">
                    <div class="card card-full" data-background-full="{{ asset('gambar/covid.jpg') }}">
                        <div class="card-body">
                            <h4 class="text-dark">Always wear Mask!</h4>
                            <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                            </p>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-dark">Top Categories</h5>
                    <div class="list-group">
                        @foreach ($category as $category)
                        <a href="#" class="list-group-item list-group-item-action">
                            <h4 class="text-dark">{{ $category->name }}</h4>
                            <small class="text-muted">{{ $category->description }}</small>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
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
            $div.append($html);
        });

        $(this).data('page', (parseInt($page) + 1)); //update page #
    });
</script>
@endsection