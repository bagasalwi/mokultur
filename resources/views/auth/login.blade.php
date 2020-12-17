@extends('front.layouts.master-auth')

@section('meta_title')Login @endsection
@section('bg-color')primary-pattern-1 @endsection

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="login-brand">
            <img src="{{ asset('gambar/logo/KREASIBANGSA.png')}}" alt="logo" width="250">
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card card-body bd-radius-4">
                    <div class="mb-4">
                        <h2 class="text-center text-primary no-pm">SIGN IN</h2>
                        <div class="text-center">
                            <small>Make an Article or Reviews of Yours, Share the Joy!</small>
                        </div>
                    </div>
                    <form method="POST" action="#" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-block">
                                <div class="float-right">
                                    <a href="{{ route('password.request') }}" class="text-small">
                                        Lupa Password?
                                    </a>
                                </div>
                            </div>
                            <label>Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" tabindex="2"
                                name="password" required autocomplete="current-password">
                            @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember-me"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="text-muted">Don't have an Account ?
                            <a class="text-primary mx-2" href="{{ url('register') }}">Create Account</a>
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