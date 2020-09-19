@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 offset-md-2">
                <h4><span class="badge badge-dark px-4">{{ $post->category->name }}</span></h4>
                <h1 class="text-dark">{{ $post->title }}</h1>
                <hr>
                {{-- Profile --}}
                <div class="row my-2">
                    <div class="col-6 d-flex flex-row">
                        <div class="align-self-center mr-2">
                            <img alt="image" width="45" height="45"
                                src="{{ URL::asset('gambar/profile_pic/' . $post->user->profile_pic) }}"
                                class="rounded-circle">
                        </div>
                        <div class="align-self-center">
                            <h5 class="p-0 m-0 font-weight-light">
                                <a class="text-dark"
                                    href="{{ url('creator/' . $post->user->username) }}">{{ $post->user->name }}</a>
                            </h5>
                            <p class="p-0 m-0"><small class="text-dark">Since {{ $post->user->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-row-reverse">
                        <div class="align-self-end">
                            <p class="p-0 m-0">Published {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                {{-- Photo --}}
                <img src="{{ asset('storage/' . $post->photo()) }}" class="img-fluid w-100">
                {{-- Content --}}
                <div id="posting" class="my-4">
                    {!! $post->description !!}
                </div>

                <div class="mt-2" id="disqus_thread"></div>

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
                                    src="{{ asset('storage/'. $p->photo()) }}" alt="">
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
            {{-- <div class="col-md-4">
                @include('layouts.side-profile')
            </div> --}}
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