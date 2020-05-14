@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ $error }}
            </div>
        </div>
        @endforeach
        @endif

        <div class="row">
            <div class="col-md-4 col-sm-12">
                @include('layouts.side-profile')
            </div>

            <div class="col-md-8 col-sm-12">
                @include('layouts.top-menu')
                <div class="card">
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
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
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
                                                    <input type="text" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ $user->email }}" required="">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label>Deskripsi</label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    cols="4" style="height:50px;"
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
                                            <a href="{{ url()->previous() }}"
                                                class="btn btn-secondary mr-1">Batal</a>
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show" id="password" role="tabpanel"
                                aria-labelledby="password-tab">
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
                                                    <input id="new-password" type="password" class="form-control"
                                                        name="new_password" required>
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
                                            <a href="{{ url()->previous() }}"
                                                class="btn btn-secondary mr-1">Batal</a>
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
@endsection