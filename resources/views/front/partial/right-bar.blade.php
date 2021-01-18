<div class="col-lg-3 col-sm-12 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            <div class="card-body">
                <div id="covid19" style="height: 180px; margin: 0 auto;"></div>
                <h5 class="text-center">Always <span class="text-primary fw-700">Wear Mask!</span></h5>
                <p class="text-center">Due to COVID19, Always Wear Mask and Social Distancing!
                </p>
            </div>
        </div>

        <h5 class="mt-4 fw-700">Top <span class="text-primary">Tag's</span></h5>
        <div class="list-group">
            @foreach ($top_tags as $p)
            <a href="{{ route('tag','tag='.$p->slug) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">#{{ $p->name }}
                <span class="badge badge-primary badge-pill">{{ $p->count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>