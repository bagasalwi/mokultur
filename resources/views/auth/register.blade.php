@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="my-4">
            <h4 class="text-center font-weight-normal">Register your Account</h4>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <hr>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" data-indicator="pwindicator"
                                    class="form-control pwstrength @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
        
                                @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password2" class="d-block">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                            <label class="custom-control-label" for="agree">Saya Setuju dengan Syarat &
                                Ketentuan</label>
                        </div>
                    </div>  
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block">
                            Daftar Akun
                        </button>
                    </div>
                </form>
                <div class="text-center">
                    <p class="no-pm text-muted">Sudah punya akun ? 
                        <a class="text-dark mx-2" href="{{ url('login') }}">Sign In</a>
                    </p>
                    <p class="no-pm">
                        <a class="text-dark" href="{{ url('/') }}">Back to Home</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection