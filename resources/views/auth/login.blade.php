@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="my-4">
            <h5 class="text-center font-weight-normal">Login to your Account</h5>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <hr>
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
                        <button type="submit" class="btn btn-dark btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
                <div class="text-center">
                    <p class="no-pm">Don't have an Account?
                        <a class="text-dark font-weight-bold" href="{{ url('register') }}">Create Account</a>
                    </p>
                    <p class="no-pm">
                        <a class="text-dark font-weight-bold" href="{{ url('/') }}">Back to Home</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection