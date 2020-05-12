<div class="sticky-top" style="top: 2em;">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <img class="rounded-circle text-center" width="150" height="150"
                    src="{{ URL::asset('gambar/profile_pic/' . $user->profile_pic) }}" alt="...">
            </div>
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
                <h4 class="text-primary text-center">{{ $user->name }}</h4>
                <div class="profile-widget-description">
                    <p>{{ $user->description }}</p>
                </div>
                
            </div>
            
        </div>
        <div class="card-footer text-center">
            <div class="font-weight-bold mb-2">Follow On</div>
            <a href="https://facebook.com/{{ $user->facebook }}" target="_blank"
                class="btn btn-block btn-outline-primary mr-2">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="https://instagram.com/{{ $user->instagram }}" target="_blank"
                class="btn btn-block btn-outline-primary">
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </div>
    </div>
</div>