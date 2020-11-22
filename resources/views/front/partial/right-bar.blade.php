<div class="col-lg-3 col-sm-12">
    <div class="stickydiv">
        <div class="card card-full bd-radius-4">
            {{-- <div class="card-overlay bd-radius-4"></div> --}}
            <div class="card-body">
                <div id="covid19" style="max-width: 400px; margin: 0 auto;"></div>
                <h4 class="text-primary">Always wear Mask!</h4>
                <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                </p>
            </div>
        </div>
        <hr>
        <h4 class="text-dark">Top Topic's</h4>
        <div class="list-group">
            @foreach ($topCategory as $category)
            <div class="card card-hover border-0 bd-radius-4 my-2" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-overlay bd-radius-4"></div>
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-item-center text-white">
                            <h1 class="no-pm" style="text-shadow: 1px 1px #000">{{ $category->name }}</h1>
                            <p>{{ $category->description }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>