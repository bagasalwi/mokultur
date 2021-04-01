<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Post extends Model
{
    use Taggable;

    protected $guarded = [];
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $appends = ['tipe_post'];

    public function getTypeAttribute()
    {
        return $this->tipe_post;
    }

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
        $post = $this->hasOne(PostPhoto::class)->first();
        if($post){
            return $post->name;
        }else{
            return "no-image";
        }
    }

    public function images(){
        return $this->hasMany(PostPhoto::class);
    }

    public function checkStatus(){
        
        if($this->status){
            $status = '';

            if($this->status == 'D'){
                $status = 'DRAFT';
            }elseif($this->status == 'P'){
                $status = 'PUBLISH';
            }else{
                $status = 'NULL';
            }
            return $status;
        }else{
            return 'NULL';
        }

    }
}
