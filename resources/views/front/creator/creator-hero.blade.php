<div class="jumbotron jumbotron-fluid pattern-1 mb-0">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-body bd-radius-8 shadow border-0 m-2">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-12 my-2">
                        <div class="d-flex justify-content-center">
                            <img class="rounded-circle" width="120" height="120"
                                src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 d-flex flex-column align-self-center my-2">
                        <small>Active since {{ $user->created_at->format('M Y') }}</small>
                        <div class="my-1">
                            <h1 class="no-pm">{{ $user->name }}</h1>
                        </div>
                        <p class="text-secondary">{{ $user->description }}</p>
                        <div class="flex-row">
                            @if ($user->facebook)
                            <a class="btn btn-facebook" href="https://facebook.com/{{ $user->facebook }}"
                                target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            @endif
                            @if($user->instagram)
                            <a class="btn btn-instagram" href="https://instagram.com/{{ $user->instagram }}"
                                target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>