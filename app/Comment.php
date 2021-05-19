<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
