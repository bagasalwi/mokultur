<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $guarded = [];

    protected $table = 'categories';

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function countPost(){
        return $this->hasMany(Post::class, 'category_id')->count();
    }
}
