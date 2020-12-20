<div class="jumbotron jumbotron-fluid primary-pattern-1 pb-0 mb-0">
    <div class="mini-section">
        <div class="container">
                <div class="card card-body bd-radius-8 shadow border-0 m-2">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-12 my-2">
                            <div class="d-flex justify-content-center">
                                <img class="rounded-circle" width="120" height="120"
                                    src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-8 d-flex flex-column align-self-center my-2">
                            <i><h6>Active since {{ $user->created_at->format('M Y') }}</h6></i>
                            
                            <div class="my-1">
                                <h1><span class="text-primary">{{ $greetings }},</span> {{ $user->name }} !</h1>
                            </div>
                            <p class="text-secondary">{{ $user->description }}</p>
                            <div class="flex-row">
                                <a class="btn btn-dark px-2" href="{{ route('profile') }}">Edit Profile</a>
                                <a class="btn btn-primary px-2" href="{{ route('post.index') }}">Manage My
                                    Post</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>