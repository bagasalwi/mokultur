<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(PostCategory::class);
    }

    public function tags(){
    	return $this->belongsToMany(Tag::class);
    }
    
    public function photo(){
        return $this->hasOne(PostPhoto::class)->first()->name;
    }
}
