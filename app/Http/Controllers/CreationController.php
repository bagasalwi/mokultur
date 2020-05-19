<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCategory;
use App\User;
use App\Sidebar;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Auth;
use DB;
use Image;
use File;
use Session;

class CreationController extends Controller
{
    public function search_creation(Request $request)
    {
        $data['title'] = 'KREASI';
        $data['user'] = Auth::user();

        $data['search'] = $request->search;
        $data['post'] = Post::where('status', 'P')
                        ->orderBy('created_at', 'desc')
                        ->where('title', 'like', "%".$data['search']."%")->paginate(6);

        return view('front.home.creation_find', $data);
    }

    // public function browse(){
    //     $data['title'] = 'KREASI';
    //     $data['creation'] = DB::table('posts')->where('status', 'P')->orderBy('created_at','desc')->paginate(9);

    //     $data['category'] = PostCategory::get();

    //     return view('front.home.creation', $data);
    // }

    public function creation()
    {
        $data['title'] = 'KREASI';
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at','desc')->paginate(6);

        $data['category'] = PostCategory::all();

        return view('front.home.creation', $data);
    }

    public function creation_detail($slug)
    {
        $data['title'] = 'KREASI';
        $data['post'] = Post::where('slug', $slug)->first();
        $data['user'] = User::where('id', $data['post']->user_id)->first();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

        if($data['post']){
            // $blogkey = 'post' . $data['post']->id;
        
            // // Check if blog session key exists
            // if (!Session::has($blogkey)) {
            //     Session::put($blogkey, 1);
            // }
            Post::where('id', $data['post']->id)->increment('view_count');
    
            return view('front.home.creation_detail', $data);
        }else{
            return redirect()->back();
        }
    }

    public function category_creation($name){
        $data['title'] = 'KREASI';
        $post = PostCategory::where('name', $name)->first();

        $data['name'] = $name;
        $data['category'] = PostCategory::get();

        $data['post'] = Post::where('category_id', $post->id)->orderBy('created_at','desc')->paginate(6);

        return view('front.home.creation_category', $data);
    }
}
