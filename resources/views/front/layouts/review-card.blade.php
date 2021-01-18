<div class="row">
    @foreach ($review as $p)
    <div class="col-lg-{{ $col }} col-md-6 col-sm-6 my-2">
        <a href="{{ route('review.detail',[$p->user->username,$p->slug]) }}"
            class="card-block clearfix">
            <div class="card border-0 bd-radius-4 shadow h-100">
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
                <div class="card-body">
                    @php
                    $tags = explode(',',$p->review_genre);   
                    @endphp
                    <div class="scrolling-wrapper-flexbox mb-2">
                        <div class="badges">
                            @foreach ($tags as $tag)
                            <a href="#" class="badge badge-primary"
                                value="{{$tag}}">{{$tag}}</a>
                            @endforeach
                        </div>
                    </div>
                    <h5><a class="text-dark fw-600"
                            href="{{ route('review.detail',[$p->user->username,$p->slug]) }}">{{ $p->title }}</a>
                    </h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>