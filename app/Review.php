<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Review extends Model
{
    use Taggable;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function photo(){
        $review = Review::where('id', $this->id)->first();
        if($review){
            return $review->review_image;
        }else{
            return "no-image";
        }
    }
}
