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
}
