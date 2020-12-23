<?php

namespace App\Services;

use App\User;
use App\Review;
use File, DB, Auth, Image;
use Carbon\Carbon;

class ReviewServices
{
    public function model()
    {
        return Review::all();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function reviewCountAuth($id)
    {
        return Review::where('user_id', $id)->count();
    }

    public function reviewStatusChecker($slug)
    {
        $review = Review::where('slug', $slug)->first();
        if ($review->status == 'D') {
            return "DRAFT";
        } elseif ($review->status == 'P') {
            return "PUBLISH";
        } else {
            return redirect()->back();
        }
    }

    public function draftedDetailReview($slug)
    {
        return Review::where('slug', $slug)->where('status', 'D')->first();
    }

    public function publishedDetailReview($slug)
    {
        return Review::where('slug', $slug)->where('status', 'P')->with('tagged')->first();
    }

    public function allReviewUser($paginate = null)
    {
        if ($paginate) {
            return Review::where('user_id', auth()->user()->id)->paginate($paginate);
        } else {
            return Review::where('user_id', auth()->user()->id)->get();
        }
    }

    public function latestPublishedReview($paginate = null)
    {
        if ($paginate) {
            return Review::where('status', 'P')->orderBy('created_at', 'desc')->paginate($paginate);
        } else {
            return Review::where('status', 'P')->orderBy('created_at', 'desc')->get();
        }
    }

    public function takePublishReview($take){
        if ($take) {
            return Review::where('status', 'P')->orderBy('created_at', 'desc')->take($take)->get();
        } else {
            return Review::where('status', 'P')->orderBy('created_at', 'desc')->take(5)->get();
        }
    }

    public function allReview($paginate = null)
    {
        if ($paginate) {
            return Review::paginate($paginate);
        } else {
            return Review::all();
        }
    }

    public function draftReview($paginate = null)
    {
        if ($paginate) {
            return Review::where('status', 'D')->where('user_id', auth()->user()->id)->paginate($paginate);
        } else {
            return Review::all()->where('status', 'D')->where('user_id', auth()->user()->id);
        }
    }

    public function userReviewCount()
    {
        return $this->allReviewUser()->count();
    }

    public function create($request, $photo)
    {
        $user = auth()->user();
        
        $review = New Review;
        
        if($photo){
            $path = $photo->store('images/review');
        }
        // dd($path);

        $review->user_id = $user->id;
        $review->review_name = $request['review_name'];
        $review->review_image = $path;
        $review->review_synopsis = $request['review_synopsis'];
        $review->review_releasedate = $request['review_releasedate'];
        $review->review_genre = implode(', ', $request['review_genre']);
        $review->review_studio = $request['review_studio'];
        $review->review_link = $request['review_link'];
        $review->title = $request['title'];
        $review->slug = str_slug($request['title'], '-');
        $review->content = $request['content'];
        $review->score = $request['score'];
        $review->recommend = $request['recommend'];
        $review->unrecommend = $request['unrecommend'];
        $review->status = $request['status'];
        $review->save();

        if(isset($request['review_genre'])){
            $review->retag($request['review_genre']);
        }

        return $review;
    }

    public function update($request, $photo)
    {
        $user = auth()->user();

        $review = $this->find($request['id']);

        if($photo){
            // dd($photo);
            if ($review->review_image) {
                $lastImage = public_path('storage/' . $review->review_image); // get previous image from folder
                
                if (File::exists($lastImage)) { // unlink or remove previous image from folder
                    unlink($lastImage);
                }
                $path = $photo->store('images/review');
                $review->review_image = $path;
    
            } else {
                $path = $photo->store('images/review');
                $review->review_image = $path;
            }
        }

        $review->user_id = $user->id;
        $review->review_name = $request['review_name'];
        
        $review->review_synopsis = $request['review_synopsis'];
        $review->review_releasedate = $request['review_releasedate'];
        
        if(isset($request['review_genre'])){
            $review->retag($request['review_genre']);
            $review->review_genre = implode(',', $request['review_genre']);
        }
        
        $review->review_studio = $request['review_studio'];
        $review->review_link = $request['review_link'];
        $review->title = $request['title'];
        $review->slug = str_slug($request['title'], '-');
        $review->content = $request['content'];
        $review->score = $request['score'];
        $review->recommend = $request['recommend'];
        $review->unrecommend = $request['unrecommend'];
        $review->status = $request['status'];
        $review->save();

        return $review;
    }

    public function delete($id)
    {
        $review = $this->find($id);

        $review->untag();

        if ($review->review_image) {
            $image = public_path('storage/' . $review->review_image); // get previous image from folder
            if (File::exists($image)) { // unlink or remove previous image from folder
                unlink($image);
            }
        }

        Review::where('id', $id)->delete();
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

    public function createMultipleImage($id, $image)
    {
        $user = auth()->user();

        foreach ($image as $img) {
            $path = $img->store('images');

            PostPhoto::create([
                'user_id' => $user->id,
                'post_id' => $id,
                'name' => $path,
                'status' => 'A'
            ]);
        }
    }

    public function updateMultipleImage($id, $image)
    {
        $this->deleteMultipleImage($id);
        $this->createMultipleImage($id, $image);
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
