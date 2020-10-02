<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\PostPhoto;
use App\Tag;
use App\PostCategory;
use App\Sidebar;
use File, DB, Auth, Image;
use Carbon\Carbon;

class PostServices{
    public function model(){
        return Post::all();
    }

    public function find($id)
	{
		return $this->model()->find($id);
    }
    
    public function publishedDetailPost($slug){
        return Post::where('slug',$slug)->where('status','P')->first();
    }

    public function allPostUser($paginate = null){
        if($paginate){
            return Post::where('user_id', auth()->user()->id)->paginate($paginate);
        }else{
            return Post::where('user_id', auth()->user()->id)->get();
        }
    }

    Public function latestPublishedPost($paginate = null){
        if($paginate){
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate($paginate);
        }else{
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->get();
        }
    }

    Public function allPost($paginate = null){
        if($paginate){
            return Post::paginate($paginate);
        }else{
            return Post::all();
        }
    }

    public function draftPost($paginate = null){
        if($paginate){
            return Post::where('status', 'D')->where('user_id', auth()->user()->id)->paginate($paginate);
        }else{
            return Post::all()->where('status', 'D')->where('user_id', auth()->user()->id);
        }
    }

    public function postByCategories($category_id){
        return Post::where('status', 'P')->where('category_id',$category_id)->orderBy('created_at', 'desc')->paginate(2);
    }

    public function userPostCount(){
        return $this->allPostUser()->count();
    }

    public function create($request){
        $user = auth()->user();
        
        $post = Post::create([
            'title' => $request['title'],
            'slug' => str_slug($request['title'], '-') . '-' . str_random(5),
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'view_count' => 0,
            'date_published' => $request['status'] == 'P' ? Carbon::now() : null,
            'type' => $request['type'],
            'status' => $request['status'],
        ]);

        $post->retag($request['tags']);

        return $post;
    }

    public function update($request){
        $user = auth()->user();
        
        Post::where('id', $request['id'])->where('user_id',$user->id)->update([
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'date_published' => $request['status'] == 'P' ? Carbon::now() : null,
            'status' => $request['status'],
        ]);

        $post = $this->find($request['id']);

        if($request['tags']){
            $post->retag($request['tags']);
        }
        return $post;
    }

    public function delete($id){
        $post = $this->find($id);

        $post->untag();

        Post::where('id', $id)->delete();
    }

    public function createImage($id,$image){
        $user = auth()->user();

        $path = $image->store('images');

        PostPhoto::create([
            'user_id' => $user->id,
            'post_id' => $id,
            'name' => $path,
            'status' => 'A'
        ]);
    }

    public function createMultipleImage($id,$image){
        $user = auth()->user();

        foreach($image as $img){
            $path = $img->store('images');

            PostPhoto::create([
                'user_id' => $user->id,
                'post_id' => $id,
                'name' => $path,
                'status' => 'A'
            ]);
        }
    }

    public function updateMultipleImage($id,$image){
        $this->deleteMultipleImage($id);
        $this->createMultipleImage($id,$image);
    }

    public function updateImage($id,$image){
        $user = auth()->user();
        $post = $this->find($id);

        $lastImage = public_path('storage/' . $post->photo()); // get previous image from folder

        if (File::exists($lastImage)) { // unlink or remove previous image from folder
            unlink($lastImage);
        }

        $path = $image->store('images');

        PostPhoto::where('post_id', $post->id)->update([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'name' => $path,
            'status' => 'A'
        ]);
    }

    public function deleteImage($id){
        $post = $this->find($id);

        if($post->photo()){
            $image = public_path('storage/' . $post->photo()); // get previous image from folder
            if (File::exists($image)) { // unlink or remove previous image from folder
                 unlink($image);
            }
    
            PostPhoto::where('post_id',$post->id)->delete();
        }
    }

    public function deleteMultipleImage($id){
        $postPhoto = PostPhoto::where('post_id',$id)->get();

        foreach($postPhoto as $img){
            $image = public_path('storage/' . $img->name);

            if (File::exists($image)) {
                unlink($image);
           }
        }

        PostPhoto::where('post_id',$id)->delete();
    }
}