@extends('front.layouts.master')

@section('content')
{{-- <div class="jumbotron jumbotron-fluid" style="background-color:#ff6ca9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="text-white font-weight-normal text-center mb-4">Cari Kreasi</h1>
                <form action="{{ url('creation/search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Kreasi kesukaan mu!">
                        <div class="input-group-append">
                            <button class="btn btn-light"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="section">
    <div class="container">
        <div class="row">
            @include('front.partial.index-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection