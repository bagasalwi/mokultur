<h5 class="my-1">Mokultur <span class="text-primary fw-700">Review's</span></h5>
<div class="card-img-wrap bd-radius-2">
    <img class="card-img-top img-fluid img-imagereview" loading="lazy"
        src="{{ asset('storage/' . $review->photo()) }}" alt="">
    <div class="card-img-overlay">
        <?php
        if($review->score < 7 && $review->score > 5){
            $score_color = 'warning';
        }elseif($review->score < 5){
            $score_color = 'danger';
        }else{
            $score_color = 'success';
        }   
        ?>
        <div class="badge badge-{{ $score_color }} align-self-center bd-radius-2">
            <span>Score</span>
            <h6 class="no-pm">{{ $review->score }}/10</h6>
        </div>
    </div>
</div>
<p class="text-dark my-1 m-0 fw-600">{{ $review->title }}</p>
<a href="{{ route('review.detail',[$review->user->username,$review->slug]) }}" class="btn btn-sm btn-block btn-primary">Baca Review</a>