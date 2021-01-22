<div class="my-4">
    <a href="{{ route('review.detail',[$selanjutnya->user->username,$selanjutnya->slug]) }}" class="clearfix">
        <div class="card card-hover bd-radius-4 shadow py-2 px-2 my-4">
            <div class="row align-items-center">
                <div class="col-4 col-lg-2 col-md-4 col-sm-12">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid d-block shadow-sm bd-radius-4" height="200" loading="lazy"
                    src="{{ asset('storage/' . $selanjutnya->photo()) }}" alt="">
                    </div>
                </div>
                <div class="col-8 col-lg-10 col-md-8 ml-0 pl-1">
                    <span class="badge badge-info">BACA SELANJUTNYA</span>
                    <span class="badge badge-{{ $score_color2 }} d-none d-lg-block align-self-center bd-radius-2 shadow">
                        Score : {{ $selanjutnya->score }}/10
                    </span>
                    <div class="my-1">
                        <h5 class="no-pm">{{ $selanjutnya->title }}</h5>
                    </div>
                    <div class="d-none d-lg-block">
                        <div class="text-secondary text-small no-pm ">{{ str_limit(strip_tags($selanjutnya->review_synopsis),280,'...') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>