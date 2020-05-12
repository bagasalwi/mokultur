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
                        <h4>Verfikasi Email</h4>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Verifikasi telah dikirim melalui email, silahkan cek email anda!') }}
                        </div>
                        @endif

                        {{ __('Sebelum masuk, silahkan cek email untuk verifikasi.') }}
                        {{ __('Jika belum mendapat email') }},
                        <a href="{{ route('verification.resend') }}">{{ __('Klik disini untuk request kembali') }}</a>.
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Ingin coba masuk kembali ? <a href="{{ url('login') }}">Masuk</a>
                </div>
                <div class="mt-2 text-muted text-center">
                    <a href="{{ url('/') }}">Kembali ke halaman utama</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection