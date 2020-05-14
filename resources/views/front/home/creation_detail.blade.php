@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="m-4">
                        <h1 class="text-dark font-weight-boldness">{{ $post->title }}</h1>
                        <div class="mt-2">
                            <a>{{ $post->category->name }}</a>
                            <div class="bullet"></div>
                            <a><i class="fas fa-eye"></i> {{ $post->view_count }} Viewed</a>
                            <div class="bullet"></div>
                            <a>{{ $post->created_at->diffForHumans() }}</a>
                            <a class="float-right">{{ $post->created_at->format('d M Y') }}</a>
                            <div class="align-left">
                            </div>
                        </div>
                    </div>
                    <img src="{{ URL::asset('gambar/user_post/' . $post->thumbnail) }}" class="img-fluid w-100 mb-4 border-top border-bottom">
                    <div class="card-body">
                        {!! $post->description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('layouts.side-profile')
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("img").addClass("img-fluid");
        });
    </script>
@endsection