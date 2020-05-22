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
                            <a><i class="fas fa-eye"></i> {{ $post->view_count }}</a>
                            <div class="bullet"></div>
                            <a>{{ $post->created_at->diffForHumans() }}</a>
                            <a class="float-right">{{ $post->created_at->format('d M Y') }}</a>
                        </div>
                    </div>
                    <img src="{{ URL::asset('gambar/user_post/' . $post->thumbnail) }}"
                        class="img-fluid w-100 mb-4 border-top border-bottom">
                    <div class="card-body">
                        <div class="mb-4">
                            {!! $post->description !!}
                        </div>
                        <a href="{{ url('creation/category/' . $post->category->name) }}"
                            class="badge badge-primary">{{ $post->category->name }}</a>
                        <hr>
                        <div class="sharethis-inline-share-buttons"></div>
                        <div class="mt-2" id="disqus_thread"></div>
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
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec27a5c1fa87300122c9912&product=inline-share-buttons&cms=website' async='async'></script>

<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://kreasibangsa.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
        powered by Disqus.</a></noscript>
<script>
    $(document).ready(function(){
            $("img").addClass("img-fluid");
        });
</script>
@endsection