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
                            <div id="posting">
                                {!! $post->description !!}
                            </div>
                        </div>
                        <a href="{{ url('creation/category/' . $post->category->name) }}"
                            class="badge badge-primary">{{ $post->category->name }}</a>
                        <hr>
                        <div class="mt-2" id="disqus_thread"></div>
                    </div>
                </div>

                @if ($recomendation->isNotEmpty())
                <h4 class="text-dark my-4">Topik Rekomendasi</h4>
                <div class="row">
                    @foreach ($recomendation as $p)
                    <div class="col-6 col-md-6 col-lg-4 mb-4">
                        <div class="card card-hover h-100">
                            <div class="card-header border-bottom">
                                <img alt="image" width="45" height="45"
                                    src="{{ URL::asset('gambar/profile_pic/' . $p->user->profile_pic) }}"
                                    class="rounded-circle mr-2">
                                <h6><a href="{{ url('creator/' . $p->user->username) }}">{{ $p->user->name }}</a></h6>
                            </div>
                            <div class="embed-responsive embed-responsive-4by3">
                                <img class="embed-responsive-item img-fluid"
                                    src="{{ URL::asset('gambar/user_post/' . $p->thumbnail) }}" alt="">
                            </div>
                            <div class="card-body border-top">
                                <a class="stretched-link" href="{{ url('creation/' . $p->slug) }}">
                                    <h6>{{ $p->title }}</h6>
                                </a>
                                <div class="mt-2">
                                    <a>{{ $p->category->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
            <div class="col-md-4">
                @include('layouts.side-profile')
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec27a5c1fa87300122c9912&product=inline-share-buttons&cms=website'
    async='async'></script>

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
        $('#posting img').addClass('img-fluid');
        });
</script>
@endsection