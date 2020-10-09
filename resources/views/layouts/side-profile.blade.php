<div class="sticky-top" style="top: 2em;">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <img class="rounded-circle my-2" width="150" height="150" 
                    src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
            </div>
            <a href="{{ url('creator/'. $user->username) }}" class="text-primary text-center"><h4 >{{ $user->name }}</h4></a>
            <div class="profile-widget">
                <div class="profile-widget-header">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Posts</div>
                            <div class="profile-widget-item-value">{{ $post_count }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Username</div>
                            <div class="profile-widget-item-value">{{ $user->username }}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <p>{{ $user->description }}</p>
                </div>

            </div>

        </div>
        <div class="card-footer text-center">
            <div class="font-weight-bold mb-2">Follow On</div>
            <button class="btn btn-block btn-outline-info" onclick="location.href='https://facebook.com/{{ $user->facebook }}';">
                <i class="fab fa-facebook"></i> Facebook
            </button>
            <button class="btn btn-block btn-outline-primary" onclick="location.href='https://instagram.com/{{ $user->instagram }}';">
                <i class="fab fa-instagram"></i> Instagram
            </button>
        </div>
    </div>
</div>