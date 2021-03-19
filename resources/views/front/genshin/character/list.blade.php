@extends('front.layouts.master')
{{-- {{ dd($list) }} --}}
@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Article's Room!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Browse published article within all creators right here, Explore!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            @foreach ($list as $key => $item)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a class="clearbox" href="{{ url('genshin/characters/' . $item->name) }}">
                        <div class="card card-hover bd-radius-4 mb-2 bg-dark">
                            <div class="row p-2">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mx-auto my-auto">
                                    <img src="{{ $item->icon }}" width="60" height="60" alt="">
                                    {{-- <img class="img-thumbnail" src="{{ $item->elements }}" width="60" height="60" alt=""> --}}
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6 col-12 mx-auto my-auto">
                                    <h4 class="fw-600">
                                        {{ ucfirst($item->name) }}
                                    </h4>
                                </div>
                            </div>
                            {{-- <img src="{{ $item->portrait }}" width="50" height="50" alt=""> --}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

