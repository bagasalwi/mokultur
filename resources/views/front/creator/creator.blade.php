@extends('front.layouts.master')

@section('meta_title')Creators @endsection

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Creator's Room!</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    See who behind the mask under those cool Article & Reviews? Explore!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-body border-0 bd-radius-4 shadow-sm mb-4">
                    <h6 class="text-primary no-pm">Search Creator :</h6>
                    <form action="{{ url('creator') }}" role="search">
                        <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                            value="{{ isset($search_meta ) ? $search_meta : ""  }}">
                    </form>
                </div>
                <div class="row">
                    @foreach ($creator as $cr)
                    <div class="col-md-3 col-sm-12">
                        <a href="{{ route('creator.detail',$cr->username) }}" class="card-block clearfix">
                            <div class="card card-hover h-100 shadow-sm bd-radius-8">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="rounded-circle img-cover" width="90" height="90"
                                            src="{{ asset('storage/' . $cr->profile_pic) }}" alt="...">
                                        <div class="my-2">
                                            <h4 class="no-pm">{{ $cr->name }}</h4>
                                        <p class="text-muted no-pm">{{ $cr->username }}</p>
                                        </div>
                                    </div>
                                    {{-- <a href="" class="btn btn-sm btn-block btn-primary">Check Description</a> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="col d-flex justify-content-center">
                        {{ $creator->links() }}
                    </div>
                </div>
            </div>
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection