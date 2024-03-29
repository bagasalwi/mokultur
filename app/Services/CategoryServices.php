<?php

namespace App\Services;

use App\User;
use App\PostCategory;
use App\Sidebar;
use File, DB, Auth, Image;
use Carbon\Carbon;

class CategoryServices{
    public function model(){
        return PostCategory::all();
    }

    public function find($id)
	{
		return $this->model()->find($id);
    }
    
    public function topCategory(){
        return PostCategory::orderBy('created_at', 'desc')->take(3)->get();
    }

    public function findSlug($slug){
        return PostCategory::where('slug',$slug)->first();
    }

    public function findEvent(){
        return PostCategory::where('status', 'E')->first();
    }

    Public function allCategory($paginate = null){
        if($paginate){
            return PostCategory::paginate($paginate);
        }else{
            return PostCategory::all();
        }
    }

    public function categoryTake($num){
        return PostCategory::take($num)->get();
    }

    public function create($request,$image){
        // dd($request);
        $user = auth()->user();

        if($image){
            $path = $image->store('images/category');
        }else{
            $path = 'images/category/default-banner.png';
        }
        
        $category = PostCategory::create([
            'name' => $request['name'],
            'slug' => str_slug($request['name'], '-'),
            'description' => $request['description'],
            'banner' => $path,
            'status' => 'A'
        ]);

        // dd($category);

        return $category;
    }

    public function update($id,$request,$image){
        // dd($image);
        $cat = $this->find($id);
        $path = '';

        if($image !== null && $cat->banner !== 'images/category/default-banner.png'){
            $lastImage = public_path('storage/' . $cat->banner); // get previous image from folder
            
            if (File::exists($lastImage)) { // unlink or remove previous image from folder
                unlink($lastImage);
            }
            
            $path = $image->store('images/category');
        }else{
            $path = $image->store('images/category');
        }

        $cat->name = $request['name'];
        $cat->slug = str_slug($request['name'], '-');
        $cat->description = $request['description'];
        
        if ($path != null){
            $cat->banner = $path;
        }

        $cat->status = 'A';
        $cat->save();

        // return redirect('/');
        
        // $category = PostCategory::where('id',$id)->update([
        //     'name' => $request['name'],
        //     'slug' => str_slug($request['name'], '-'),
        //     'description' => $request['description'],
        //     'banner' => $path,
        //     'status' => 'A'
        // ]);

        return $cat;
    }

    public function delete($id){
        $cat = $this->find($id);

        if($cat->banner !== null && $cat->banner !== 'images/category/default-banner.png'){
            $image = public_path('storage/' . $cat->banner); // get previous image from folder
            
            if (File::exists($image)) { // unlink or remove previous image from folder
                unlink($image);
            }
        }

        PostCategory::where('id',$id)->delete();
    }

    public function makeAnEvent($id){
        $cat = $this->find($id);

        PostCategory::where('id', '>', 0)->update(['status' => 'A']);

        PostCategory::where('id',$cat->id)->update([
            'status' => 'E'
        ]);
        
    }

    


}
