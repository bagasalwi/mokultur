<div class="col-lg-3 d-none d-lg-block">
    <div class="stickydiv">
        <div class="card card-full" data-background-full="{{ asset('gambar/covid.jpg') }}">
            <div class="card-body">
                <h4 class="text-dark">Always wear Mask!</h4>
                <p class="text-dark">Due to COVID19 pandemic, make your mask as a secondary weapon of life.
                </p>
            </div>
        </div>
        <hr>
        <h5 class="text-dark">Top Categories</h5>
        <div class="list-group">
            @foreach ($topCategory as $category)
            <div class="card card-hover my-2" data-background="{{ asset('storage/' . $category->banner) }}">
                <div class="card-body d-flex">
                    <a class="stretched-link" href="{{ url('topic/'.$category->slug) }}" style="text-decoration : none">
                        <div class="align-self-center">
                            <h4 class="text-white">{{ $category->name }}</h4>
                            <p class="text-white font-weight-normal">{{ $category->description }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>