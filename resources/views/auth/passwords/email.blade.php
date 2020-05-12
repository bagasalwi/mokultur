@extends('auth.layouts.master')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="{{ URL::asset('gambar/logo.png')}}" width="250" alt="">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Reset Password</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Reset password akan dikirim melalui email.
                                </small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Kirim Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Ingin coba masuk kembali ? <a href="{{ url('login') }}">Masuk</a>
                </div>
                <div class="mt-2 text-muted text-center">
                    <a href="{{ url('/') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection