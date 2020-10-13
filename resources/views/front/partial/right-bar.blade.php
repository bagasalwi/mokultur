<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full no-bd-radius pattern-3">
            <div class="card-overlay"></div>
            <div class="card-body">
                <h4 class="text-dark">Always wear Mask!</h4>
                <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                </p>
            </div>
        </div>
        <hr>
        <h6 class="text-dark">Top Topic's</h6>
        <div class="list-group">
            @foreach ($topCategory as $category)
            <div class="card card-hover border-0 no-bd-radius my-2" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-overlay"></div>
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-self-center">
                            <h2 class="text-white">{{ $category->name }}</h2>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>