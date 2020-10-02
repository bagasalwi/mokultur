<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Post extends Model
{
    use Taggable;

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

    public function images(){
        return $this->hasMany(PostPhoto::class);
    }
}
