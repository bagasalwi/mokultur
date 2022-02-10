<div class="row mb-3" id="reviews">
    @foreach ($review as $p)
    <div class="col-6 col-lg-{{ $col }} col-md-6 col-sm-6 my-2">
        <a href="{{ route('review.detail',[$p->user->username,$p->id,$p->slug]) }}"
            class="card-block clearfix">
            <div class="card border-0 bd-radius-2 shadow h-100">
                <div class="card-img-wrap">
                    <img class="card-img-top img-fluid img-imagereview" loading="lazy"
                    src="{{ asset('storage/' . $p->photo()) }}" alt="">
                    <div class="card-img-overlay">
                        <?php
                        if($p->score < 7 && $p->score > 5){
                            $score_color = 'warning';
                        }elseif($p->score < 5){
                            $score_color = 'danger';
                        }else{
                            $score_color = 'success';
                        }   
                        ?>
                        <div class="badge badge-{{ $score_color }} align-self-center bd-radius-2">
                            <span>Score</span>
                            <h6 class="no-pm">{{ $p->score }}/10</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    @php
                    $tags = explode(',',$p->review_genre);   
                    @endphp
                    <div class="d-none d-lg-block ">
                        <div class="scrolling-wrapper-flexbox mb-2">
                            <div class="badges">
                                @foreach ($tags as $tag)
                                <a href="#" class="badge badge-primary mb-0"
                                    value="{{$tag}}">{{$tag}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a class="fw-600 text-center" href="{{ route('review.detail',[$p->user->username,$p->id,$p->slug]) }}">
                        <h4>{{ $p->title }}</h4>
                    </a>
                    <p class="text-small text-center text-secondary mt-auto no-pm">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }} &middot;
                        {{ $p->user->name }}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>