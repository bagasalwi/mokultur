@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -190px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Profile</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Customize your profile, Make your own spot!
                </p>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="card card-body bd-radius-4 shadow">
            <ul class="nav nav-pills" id="myTab3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#profile-tab" role="tab"
                        aria-controls="home" aria-selected="true">Profile</a>
                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#password-tab" role="tab"
                        aria-controls="profile" aria-selected="false">Change Password</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="profile-tab" role="tabpanel" aria-labelledby="home-tab3">
                    <form enctype="multipart/form-data" method="post" class="needs-validation"
                        action="{{ url('profile/save') }}">
                        @csrf
                        <div class="card card-body border-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center flex-column">
                                        <div class="image-upload">
                                            <label for="change-profile" style="cursor: pointer;">
                                                <img id="preview-profile" class="img-cover rounded-circle" width="180"
                                                    height="180" src="{{ asset('storage/' . $user->profile_pic) }}"
                                                    alt="...">
                                                <div class="profile-hover-image">
                                                    <div class="text">Change Image</div>
                                                </div>
                                            </label>
                                            <input id="change-profile" type="file" name="profile_pic" />
                                        </div>
                                        @error('profile_pic')
                                        <small class="text-danger">{{ $errors->first('profile_pic') }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-9 d-flex flex-column align-self-center">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label class="no-pm">Name</label>
                                                <input type="text" name="name"
                                                    class="profileInput @error('name') profile-invalid @enderror"
                                                    value="{{ old('name',$user->name) }}">
                                                @error('name')
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label class="no-pm">Username</label>
                                                <input type="text" name="username"
                                                    class="profileInput @error('username') profile-invalid @enderror"
                                                    value="{{ old('username',$user->username) }}">
                                                @error('username')
                                                <small class="text-danger">{{ $errors->first('username') }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="no-pm">About You</label>
                                        <textarea type="text" name="description" rows="3"
                                            class="profileInput @error('description') profile-invalid @enderror my-2">{{ old('description',$user->description) }}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="no-pm">Instagram</label>
                                                <input type="text" name="instagram"
                                                    class="profileInput @error('instagram') profile-invalid @enderror"
                                                    value="{{ old('instagram',$user->instagram) }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="no-pm">Facebook</label>
                                                <input type="text" name="facebook"
                                                    class="profileInput @error('facebook') profile-invalid @enderror"
                                                    value="{{ old('facebook',$user->facebook) }} ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-row">
                            <button type="submit" class="btn btn-dark float-right">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="password-tab" role="tabpanel" aria-labelledby="profile-tab3">
                    <form enctype="multipart/form-data" method="post" class="needs-validation"
                        action="{{ url('profile/password/save') }}">
                        @csrf

                        <div class="card card-body border-0">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="no-pm">Old Password</label>
                                        <input type="password" name="password"
                                            class="profileInput @error('password') profile-invalid @enderror">
                                        @error('password')
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="no-pm">New Password</label>
                                        <input id="new-password" type="password" name="new_password"
                                            class="profileInput" required>
                                        @error('new_password')
                                        <small class="text-danger">{{ $errors->first('new_password') }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="no-pm">Confirm New Password</label>
                                        <input id="password-confirm" type="password" name="new_confirm_password"
                                            class="profileInput" required>
                                        @error('new_confirm_password')
                                        <small class="text-danger">{{ $errors->first('new_confirm_password') }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-row">
                            <button type="submit" class="btn btn-dark float-right">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@if ($message = Session::get('success'))
<script>
    swal("Success!", "{{ $message }}");
</script>
@endif

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $('#preview-profile').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('select a file to see preview');
            $('#preview-profile').attr('src', '');
        }
    }

    $("#change-profile").change(function() {
        readURL(this);
    });
</script>
@endsection