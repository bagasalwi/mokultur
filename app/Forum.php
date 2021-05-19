<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = [];
    protected $table = 'forums';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ForumTag::class, 'forum_tag');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'ASC');
    }
}
