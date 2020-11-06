@extends('front.layouts.master')

@section('content')
<div class="section">
    <div class="container">
        <div class="my-4">
            <p class="no-pm">Showing result for :</p>
            <form action="{{ url('creator') }}" role="search">
                <input type="text" id="search" name="search" class="inputSearch" placeholder="Search.."
                    value="{{ isset($search_meta ) ? $search_meta : ""  }}">
            </form>
        </div>
        <div class="row">
            @foreach ($creator as $cr)
            <div class="col-md-4 col-sm-12 my-2">
                <a href="{{ route('creator.detail',$cr->username) }}" class="card-block clearfix">
                    <div class="card border-0 card-hover h-100">
                        <div class="card-body row">
                            <div class="col-4 align-self-center text-center">
                                <img class="rounded-circle img-cover" width="90" height="90"
                                    src="{{ asset('storage/' . $cr->profile_pic) }}" alt="...">
                            </div>
                            <div class="col-8 d-flex flex-column align-self-center">
                                <h2 class="no-pm">{{ $cr->name }}</h2>
                                <p class="text-muted no-pm">{{ $cr->username }}</p>
                            </div>
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
</div>
@endsection