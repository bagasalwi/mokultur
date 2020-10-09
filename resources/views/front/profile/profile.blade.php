@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form enctype="multipart/form-data" method="post" class="needs-validation"
                    action="{{ url('profile/save') }}">
                    @csrf
                    <div class="card card-body border-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex justify-content-center">
                                    <div class="image-upload">
                                        <label for="change-profile" style="cursor: pointer;">
                                            <img id="preview-profile" class="img-cover rounded-circle" width="180" height="180"
                                                src="{{ asset('storage/' . $user->profile_pic) }}" alt="...">
                                            <div class="profile-hover-image">
                                                <div class="text">Change Image</div>
                                            </div>
                                        </label>
                                        <input id="change-profile" type="file" name="profile_pic" />

                                        @error('profile_pic')
                                            <small class="text-danger">{{ $errors->first('profile_pic') }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 d-flex flex-column align-self-center">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label class="no-pm">Name</label>
                                            <input type="text" name="name"
                                                class="profileInput @error('name') profile-invalid @enderror font-weight-bold"
                                                data-font-size="40px" value="{{ old('name',$user->name) }}">
                                            @error('name')
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label class="no-pm">Username</label>
                                            <input type="text" name="username"
                                                class="profileInput @error('username') profile-invalid @enderror font-weight-bold"
                                                data-font-size="40px" value="{{ old('username',$user->username) }}">
                                            @error('username')
                                            <small class="text-danger">{{ $errors->first('username') }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="no-pm">About You</label>
                                    <textarea type="text" name="description" rows="3"
                                        class="profileInput @error('name') profile-invalid @enderror my-2">{{ old('description',$user->description) }}</textarea>
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
                                            {{-- @error('instagram') --}}
                                            {{-- <small class="text-danger">{{ $errors->first('instagram') }}</small>
                                            --}}
                                            {{-- @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="no-pm">Faceook</label>
                                            <input type="text" name="facebook"
                                                class="profileInput @error('facebook') profile-invalid @enderror"
                                                value="{{ old('facebook',$user->facebook) }} ">
                                            {{-- @error('facebook') --}}
                                            {{-- <small class="text-danger">{{ $errors->first('facebook') }}</small>
                                            --}}
                                            {{-- @enderror --}}
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

            {{-- <div class="col-md-8 col-sm-12 my-2">
                @include('layouts.top-menu')
                <div class="card mt-2">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
                                    aria-controls="detail" aria-selected="false">Change Password</a>
                            </li>
                        </ul>


                        <div class="tab-content tab-bordered" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="general-tab">
                                <form enctype="multipart/form-data" method="post" class="needs-validation"
                                    action="{{ url('profile/save') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12 col-12">
                        <label>Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ $user->name }}" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ $user->username }}" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-at"></i>
                                </div>
                            </div>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ $user->email }}" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" cols="4"
                            style="height:50px;"
                            name="description">{{old('description', $user->description)}}</textarea>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fab fa-instagram"></i>
                                </div>
                            </div>
                            <input type="text" name="instagram"
                                class="form-control @error('instagram') is-invalid @enderror"
                                value="{{old('instagram', $user->instagram)}}">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fab fa-facebook"></i>
                                </div>
                            </div>
                            <input type="text" name="facebook"
                                class="form-control @error('facebook') is-invalid @enderror"
                                value="{{old('facebook', $user->facebook)}}">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                        <label>Foto Profil</label>
                        <div class="custom-file">
                            <input type="file" class="form-control" name="profile_pic">
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Foto Profil kamu !
                        </small>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-1">Batal</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
        <div class="tab-pane fade show" id="password" role="tabpanel" aria-labelledby="password-tab">
            <form enctype="multipart/form-data" method="post" class="needs-validation"
                action="{{ url('profile/password/save') }}">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-12">
                            <label>Old Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" required=""
                                    class="form-control @error('password') is-invalid @enderror">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-12 col-12">
                            <label>New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input id="new-password" type="password" class="form-control" name="new_password"
                                    required>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label>Confirm New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="new_confirm_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-2">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mr-1">Batal</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div> --}}
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