@extends('front.layouts.master')

@section('meta_title')Topic {{ $category->name }}@endsection
@section('meta_keyword'){{ $category->name }}@endsection
@section('meta_desc'){{ str_limit(strip_tags($category->description),180,'...') }}@endsection

@section('content')
<div class="jumbotron jumbotron-fluid mb-0" data-background-topic="{{ asset('storage/' . $category->banner) }}">
    <div class="jumbotron-overlay"></div>
    <div class="container mini-section">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-white font-weight-bold">{{ $category->name }}</h1>
                <span class="text-white">{{ $category->description }}</span>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            @include('front.partial.left-bar')

            <div class="col-lg-6 col-sm-12">
                <div class="heading2">
                    <h4 class="fw-600 bolder-text">MOKULTUR <span class="font-weight-bold">BLOG</span></h4>
                </div>
                <div id="posts" class="row">        
                </div>
            </div>
            
            
            @push('script')
            <script>    
                $(document).ready(function(){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var cat_id = {{ $category->id }};
                    load_data('', _token, cat_id);
            
                    $("#carousel-post").owlCarousel({
                        items:1,
                        // margin:10,
                        autoHeight:true,
                        nav: true,
                        dots: false,
                        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
                    });

                    
            
                    function load_data(id="", _token, cat_id){
                        $.ajax({
                            url:"{{ route('post.load_data_cat') }}",
                            method:"POST",
                            data:{id:id, _token:_token, cat_id:cat_id},
                            success:function(data){
                                $('#counter').remove();
                                $('#loadpost').remove();
                                $('#posts').append(data);
                            }
                        })
                    }
            
                    $(document).on('click', '#loadpost', function(){
                        var id = $(this).data('id');
                        $('#loadpost').html('<b>Loading...</b>');
                        load_data(id, _token);
                    });
            
                });
            
            </script>
            @endpush

            @include('front.partial.right-bar')
        </div>
    </div>
</div>

@endsection