<div class="col-lg-3 col-sm-12 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            <div class="card-body">
                <div id="covid19" style="height: 180px; margin: 0 auto;"></div>
                <h5 class="text-primary">Always wear Mask!</h5>
                <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                </p>
            </div>
        </div>
        
        <h4 class="text-dark mt-3">Top Topic's</h4>
        <div class="list-group">
            @foreach ($topCategory as $category)
            <div class="card card-hover border-0 bd-radius-4 my-1" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-overlay bd-radius-4"></div>
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-item-center text-white">
                            <h4 class="no-pm">{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>