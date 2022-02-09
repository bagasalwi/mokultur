<div class="col-lg-3 col-sm-12 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            <div class="card-body">
                <div id="covid19" style="height: 180px; margin: 0 auto;"></div>
                <h4 class="text-center ">Wibukiawan, Pakai <span class="text-primary fw-600 bolder-text">MASKERNYA</span></h4>
                <p class="text-center">Kalo keluar rumah, Tolong di pakai ya Maskernya!! Nanti kaya subaru, ter-isekai-ed.
                </p>
            </div>
        </div>
        {{-- <div class="my-4">
            <a href="https://www.instagram.com/bagasalwi/" class="btn btn-block btn-dark">Join Mokultur!</a>
        </div> --}}
        <div class="heading2">
            <a href="{{ route('tag') }}">
                <h5 class="mt-4 fw-700 bolder-text">MOKULTUR <span class="text-primary">TOP TAGS</span></h5>
            </a>
        </div>
        <div class="list-group">
            @foreach ($top_tags as $p)
            <a href="{{ route('tag','tag='.$p->slug) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">#{{ $p->name }}
                <span class="badge badge-primary badge-pill">{{ $p->count }}</span>
            </a>
            @endforeach
        </div>
        <div class="mt-4">
            <p class="text-center text-small">Made with <i class="fas fa-heart" style="color:#000000"></i> by Mokultur</p>
        </div>
    </div>
</div>