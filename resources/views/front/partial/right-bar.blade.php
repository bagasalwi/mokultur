<div class="col-lg-3 col-sm-12 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            <div class="card-body">
                <div id="covid19" style="height: 180px; margin: 0 auto;"></div>
                <h4 class="text-primary text-center">Always wear Mask!</h4>
                <p class="text-center">Due to COVID19, Always Wear Mask and Social Distancing!
                </p>
            </div>
        </div>

        <h5 class="text-dark mt-3">Top Tag's</h5>
        <div class="list-group">
            @foreach ($top_tags as $p)
            <a href="{{ route('tag','tag='.$p->slug) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">#{{ $p->name }}
                <span class="badge badge-primary badge-pill">{{ $p->count }}</span>
            </a>
            @endforeach
        </div>

        {{-- <h5 class="text-dark mt-3">Top Topic's</h5>
        <div class="list-group">
            @foreach ($top_category as $category)
            <div class="card card-hover border-0 bd-radius-2 my-1"
                data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-overlay bd-radius-2"></div>
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-item-center text-white">
                            <h6 class="no-pm">{{ $category->name }}</h6>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div> --}}
    </div>
</div>