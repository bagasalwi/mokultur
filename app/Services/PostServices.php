<?php

namespace App\Services;

use App\User;
use App\Post;
use App\PostPhoto;
use File, DB, Auth, Image;
use Carbon\Carbon;

class PostServices
{
    public function model()
    {
        return Post::all();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function postCountAuth($id)
    {
        return Post::where('user_id', $id)->count();
    }

    public function postStatusChecker($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post->status == 'D') {
            return "DRAFT";
        } elseif ($post->status == 'P') {
            return "PUBLISH";
        } else {
            return redirect()->back();
        }
    }

    public function draftedDetailPost($slug)
    {
        return Post::where('slug', $slug)->where('status', 'D')->first();
    }

    public function publishedDetailPost($slug)
    {
        return Post::where('slug', $slug)->where('status', 'P')->with('tagged')->first();
    }

    public function allPostUser($paginate = null)
    {
        if ($paginate) {
            return Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate($paginate);
        } else {
            return Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        }
    }

    public function latestPublishedPost($paginate = null)
    {
        if ($paginate) {
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate($paginate);
        } else {
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->get();
        }
    }

    public function takePublishPost($take){
        if ($take) {
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->take($take)->get();
        } else {
            return Post::where('status', 'P')->orderBy('created_at', 'desc')->take(5)->get();
        }
    }

    public function allPost($paginate = null)
    {
        if ($paginate) {
            return Post::paginate($paginate);
        } else {
            return Post::all();
        }
    }

    public function draftPost($paginate = null)
    {
        if ($paginate) {
            return Post::where('status', 'D')->where('user_id', auth()->user()->id)->paginate($paginate);
        } else {
            return Post::all()->where('status', 'D')->where('user_id', auth()->user()->id);
        }
    }

    public function postByCategories($category_id)
    {
        return Post::where('status', 'P')->where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(10);
    }

    public function userPostCount()
    {
        return $this->allPostUser()->count();
    }

    public function create($request)
    {
        $user = auth()->user();

        $post = Post::create([
            'title' => $request['title'],
            // 'slug' => str_slug($request['title'], '-') . '-' . str_random(5),
            'slug' => $request['slug'],
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'view_count' => 0,
            'date_published' => $request['status'] == 'P' ? Carbon::now() : null,
            'tipe_post' => $request['tipe_post'],
            'status' => $request['status'],
        ]);

        if(isset($request['tags'])){
            $post->retag($request['tags']);
        }

        return $post;
    }

    public function update($request)
    {
        $user = auth()->user();

        Post::where('id', $request['id'])->where('user_id', $user->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'date_published' => $request['status'] == 'P' ? Carbon::now() : null,
            'status' => $request['status'],
        ]);

        $post = $this->find($request['id']);

        if (isset($request['tags'])) {
            $post->retag($request['tags']);
        }
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);

        $post->untag();

        Post::where('id', $id)->delete();
    }

    public function createImage($id, $image)
    {
        $user = auth()->user();

        $path = $image->store('images');

        PostPhoto::create([
            'user_id' => $user->id,
            'post_id' => $id,
            'name' => $path,
            'status' => 'A'
        ]);
    }

    public function createMultipleImage($id, $image, $order)
    {
        // dd($image);
        $user = auth()->user();

        foreach ($image as $key => $img) {
            foreach($img as $key2 => $k){

                $path = $k->store('images');

                PostPhoto::create([
                    'user_id' => $user->id,
                    'post_id' => $id,
                    'name' => $path,
                    'order' => $key2 + 1,
                    'status' => 'A'
                ]);
            }
        }
    }

    public function updateMultipleImage($id, $image = null, $order_delete = null)
    {
        $user = auth()->user();
        $post = $this->find($id);

        // dd($order_delete);
        
        if($image && $order_delete){
            foreach($image as $key => $img){
                foreach($img as $key2 => $k){
                    $order = $key2 + 1;
                    // dd($order);

                    foreach($order_delete as $od){
                        $if_order = $od == $order;
        
                        // dd($if_order);
                        if($if_order == false){
                            $postPhoto = PostPhoto::where('post_id', $id)->where('order',$od)->first();
        
                            if($postPhoto){
                                $image = public_path('storage/' . $postPhoto->name);
            
                                if (File::exists($image)) {
                                    unlink($image);
                                }
            
                                PostPhoto::where('post_id', $id)->where('order',$od)->delete();
                            }
                        }
                    }

                    $post_photo = PostPhoto::where('post_id',$id)->where('order',$order)->first();
    
                    if($post_photo){
                        $lastImage = public_path('storage/' . $post_photo->name);
    
                        if (File::exists($lastImage)) { // unlink or remove previous image from folder
                            unlink($lastImage);
                        }
                    }
    
                    $path = $k->store('images');
    
                    PostPhoto::where('post_id', $post->id)->where('order', $order)->update([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                        'name' => $path,
                        'order' => $order,
                        'status' => 'A'
                    ]);
                }
            }
        }else if($order_delete){
            foreach($order_delete as $od){
                $if_order = $od == $order;

                // dd($if_order);
                if($if_order == false){
                    $postPhoto = PostPhoto::where('post_id', $id)->where('order',$od)->first();

                    if($postPhoto){
                        $image = public_path('storage/' . $postPhoto->name);
    
                        if (File::exists($image)) {
                            unlink($image);
                        }
    
                        PostPhoto::where('post_id', $id)->where('order',$od)->delete();
                    }
                }
            }
        }else if ($image){
            foreach($image as $key => $img){
                foreach($img as $key2 => $k){
                    $order = $key2 + 1;

                    $post_photo = PostPhoto::where('post_id',$id)->where('order',$order)->first();
    
                    if($post_photo){
                        $lastImage = public_path('storage/' . $post_photo->name);
    
                        if (File::exists($lastImage)) { // unlink or remove previous image from folder
                            unlink($lastImage);
                        }
                    }
    
                    $path = $k->store('images');
    
                    PostPhoto::where('post_id', $post->id)->where('order', $order)->update([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                        'name' => $path,
                        'order' => $order,
                        'status' => 'A'
                    ]);
                }
            }
        }
    }

    public function updateImage($id, $image)
    {
        $user = auth()->user();
        $post = $this->find($id);

        if ($post->photo() == 'no-image') {
            $this->createImage($id, $image);
        } else {
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
    }

    public function deleteImage($id)
    {
        $post = $this->find($id);

        if ($post->photo()) {
            $image = public_path('storage/' . $post->photo()); // get previous image from folder
            if (File::exists($image)) { // unlink or remove previous image from folder
                unlink($image);
            }

            PostPhoto::where('post_id', $post->id)->delete();
        }
    }

    public function deleteMultipleImage($id)
    {
        $postPhoto = PostPhoto::where('post_id', $id)->get();

        foreach ($postPhoto as $img) {
            $image = public_path('storage/' . $img->name);

            if (File::exists($image)) {
                unlink($image);
            }
        }

        PostPhoto::where('post_id', $id)->delete();
    }
}
