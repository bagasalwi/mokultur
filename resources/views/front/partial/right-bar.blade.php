<div class="col-lg-3 col-sm-12 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            <div class="card-body">
                <div id="covid19" style="height: 180px; margin: 0 auto;"></div>
                <h5 class="text-center">Pakai <span class="text-primary fw-700">Masker!</span></h5>
                <p class="text-center">Pakai Selalu masker-mu kawan! jangan lupa social distancing ya!
                </p>
            </div>
        </div>
        <div class="heading2">
            <a href="{{ route('tag') }}">
                <h6 class="mt-4 fw-800"> <span class="bg-main-dark p-1">MOKULTUR <span class="text-primary">TOP TAG'S</span></span></h6>
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
            <p class="text-center">Made with <i class="fas fa-heart" style="color:#000000"></i></p>
        </div>
    </div>
</div>