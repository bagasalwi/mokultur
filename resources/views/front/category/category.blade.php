@extends('front.layouts.master')

@section('content')

<div class="owl-carousel owl-theme slider" id="slider2">
    @foreach ($category_slide as $slider)
    <div>
        <img alt="image" class="img-slider" src="{{ asset('storage/' . $slider->banner) }}">
        <div class="slider-caption text-center">
            <div class="slider-title">
                <h1 class="text-white">{{ $slider->name }}</h1>
            </div>
            <div class="slider-description">{{ $slider->description }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="container mt-4">
    <h5 class="text-primary">All Topic Categories</h5>
    <div class="row">
        @foreach ($category as $category)
        <div class="col-lg-4 cat">
            <div class="card card-topic bd-radius-8" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-overlay bd-radius-8"></div>
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-self-center">
                            <h4 class="text-white">{{ $category->name }}</h4>
                            <p class="text-white font-weight-normal">
                                {{ strlen($category->description) > 70 ? substr($category->description, 0, 75) . '...' : $category->description }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        <a id="show-cat" class="col-12 text-center arrow-down bounce" href="#"><i class="fas fa-chevron-down fa-2x text-primary"></i></a>
    </div>
</div>



<div class="section">
    <div class="container">
        <div class="row">
            @include('front.partial.left-bar')
            @include('front.partial.latest-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        $('.cat:gt(2)').hide().last().after(
            $('#show-cat').click(function(){
                var a = this;
                $('.cat:not(:visible):lt(3)').fadeIn(function(){
                    if ($('.cat:not(:visible)').length == 0)
                        $(a).remove();   
                });
                return false;
            })
        );
    </script>
@endpush