<div class="mb-2">
    <h2 class="no-pm">My Activities</h2>
    <small class="no-pm text-secondary">Your Account active since {{ auth()->user()->created_at->format('M Y') }}</small>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex justify-content-center">
                        <img class="rounded-circle" width="150" height="150"
                            src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                    </div>
                </div>
                <div class="col-md-9 d-flex flex-column align-self-center">
                    <h1><span class="text-primary">{{ $greetings }},</span> {{ $user->name }} !</h1>
                    <p class="text-secondary">{{ $user->description }}</p>
                    <div class="flex-row">
                        <a class="btn btn-sm btn-dark px-2" href="{{ route('profile') }}">Edit Profile</a>
                        <a class="btn btn-sm btn-primary px-2" href="{{ route('post.index') }}">Manage My Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>