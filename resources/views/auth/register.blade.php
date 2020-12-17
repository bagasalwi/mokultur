@extends('front.layouts.master-auth')

@section('meta_title')Register @endsection
@section('bg-color')primary-pattern-1 @endsection

@section('content')
<section class="section">
    <div class="login-brand">
        <img src="{{ asset('gambar/logo/KREASIBANGSA.png')}}" alt="logo" width="250">
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body bd-radius-4 shadow">
                    <div class="mb-4">
                        <h2 class="text-center text-primary no-pm">Register Your Account</h2>
                        <div class="text-center">
                            <small>Basically, You need to Register before login.. So Make your Account!</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>
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
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        class="form-control pwstrength @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">
                                    <div id="pwindicator" class="pwindicator w-100">
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
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="agree">Saya Setuju dengan Syarat &
                                    Ketentuan</label>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Daftar Akun
                            </button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="text-muted">Sudah punya akun ?
                            <a class="text-dark mx-2" href="{{ url('login') }}">Sign In</a>
                        </p>
                        <p>
                            <a class="text-dark" href="{{ url('/') }}">Back to Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection