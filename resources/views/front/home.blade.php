@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-gradient mb-0 starback"
    style="padding-bottom: 80px; margin-bottom: -225px !important;">
    <canvas id="canvas" style="width: 100%;height: 100%;position: absolute;inset: 0;"></canvas>
    <div class="container section">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h1 class="text-white fw-700" data-font-size="36px">Ber-kulturisasi dengan update yang lagi happening! Seperti <span id="switchtext">Geeks</span>!</h1>
                <p class="mb-3 text-white">
                    Mokultur adalah ruang terbuka untuk kalian yang mempunyai tingak kulturasi tinggi, disini gue akan berbagi macam-macam tulisan random mulai dari Geeks, Pop Culture, Film, Teknologi dan lainnya. Stay Tune!!
                </p>
                <div class="d-none d-lg-block">
                    <a class="btn btn-light text-dark px-4 mr-1 rounded-sm" href="{{ route('browse') }}" role="button">Browse</a>
                    <a class="btn btn-dark px-4 mr-1 rounded-sm" href="{{ route('creator') }}" role="button">Mokultur Creator</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="m-0 animated" id="" style="width: 100%">
                    <img class="img-fluid" src="{{ asset('gambar/mokusan.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 col-sm-12 mb-2">
                        <div class="stickydiv">
                            @foreach ($top_creation as $idx => $p)
                            @if ($idx == 0)
                            <div class="card border-0 mb-2">
                                <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-block clearfix">
                                    <div class="card-img-wrap">
                                        <img class="img-fluid img-article" loading="lazy" src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                    </div>
                                </a>
                                <div class="my-2">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="no-pm">
                                        <h4 class="fw-700">{{ $p->title }}</h4>
                                    </a>
                                    <p class="card-text text-secondary">
                                        {{ str_limit(strip_tags($p->description),160,'...') }}
                                    </p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-12 mb-2 d-none d-lg-block">
                        @foreach ($top_creation as $idx => $p)
                        @if($idx > 0)
                        <div class="card border-0 mb-3">
                            <div class="row no-gutters">
                                <div class="col-sm-4">
                                    <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-block clearfix">
                                        <div class="card-img-wrap">
                                            <img class="card-img img-imagepost-headline" loading="lazy"
                                                src="{{ asset('storage/' . $p->photo()) }}" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mx-2 mt-2 py-0">
                                        <a href="{{ url('topic/'.$p->category->slug) }}" class="text-dark text-uppercase fw-600">{{ $p->category->name }}
                                        </a>
                                        <a href="{{ route('post.detail',[$p->user->username,$p->id,$p->slug]) }}" class="card-title">
                                            <h5 class="fw-700">
                                                {{ $p->title }}
                                            </h5>
                                        </a>
                                        <p class="card-text text-secondary no-pm">
                                            {{ str_limit(strip_tags($p->description),120,'...') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid pattern-1 bg-light">
        <div class="container">
            <a href="{{ route('review') }}" class="card-block clearfix">
                <div class="hero text-white mb-3 card-hover no-bd primary-pattern-1">
                    <div class="hero-inner">
                        <h1 class="text-white">Mokultur Reviews</h1>
                        <p class="text-white no-pm">Tempat review-review film atau anime dari kreator paling edgy di mokultur, Semua reviewnya se-enak jidatnya! Tapi jangan khawatir karena dia salah satu Man of Culture.</p>
                    </div>
                </div>
            </a>
            @include('front.layouts.review-card', ['col' => '3'])
        </div>
    </div>
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
    // Start Text Typing
    const words = [
        "Geeks",
        "Anime",
        "Fandom",
        "Film",
        "Teknologi",
        "Games",
        "Design",
      ];
    const timePerWord = 3000; // milliseconds
    const timePerLetter = 50; //milliseconds
    
    let current = words[0];
    const wordEl = document.getElementById("switchtext");
    
    setInterval(switchText, timePerWord);
    
    async function switchText() {
        const index = words.indexOf(current);
        const curLength = current.length;
    
        for (let i = 0; i <= curLength; i += 1) {
            await wait(timePerLetter);
            current = current.substring(0, current.length - 1);
            wordEl.innerText = current;
        }
    
        await wait(current.length * timePerLetter);
    
        const newWord = words[index + 1] || words[0];
            for (let idx = 0; idx <= newWord.length; idx += 1) {
                await wait(timePerLetter);
                current = newWord.substring(0, idx);
                wordEl.innerText = current;
            }
    }
    
    function wait(timeout) {
        return new Promise((resolve) => setTimeout(() => resolve(), timeout));
    }

    $('#shareArticle').on('show.bs.modal', function(e) {
        var link = $(e.relatedTarget).data('link');
        var judul = encodeURIComponent($(e.relatedTarget).data('judul'));
        $('#m-whatsapp').attr('href', 'https://api.whatsapp.com/send?text='+judul+'%0A%0A'+link+'%0A%0AJangan lupa kunjungi mokultur.online untuk konten seru lainnya!!');
        $('#m-twitter').attr('href','https://twitter.com/share?text='+judul+'&url='+link+'');
        // $('#m-discord').attr('href',link);
        $('#m-facebook').attr('href','http://www.facebook.com/sharer.php?u='+link+'');
        $('#m-link').attr('href',link);
    });

    $('.copy_text').click(function (e) {
        e.preventDefault();
        var copyText = $(this).attr('href');

        document.addEventListener('copy', function(e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);

        document.execCommand('copy');  
        console.log('copied text : ', copyText);
        alert('Link berhasil di Copy'); 
    });
    // End Text Typing
    </script>
@endpush