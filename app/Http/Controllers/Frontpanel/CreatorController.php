<?php

namespace App\Http\Controllers\Frontpanel;

use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\UserServices;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Sidebar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth,DB,Image,File,Session;

class CreatorController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService, UserServices $userService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function creator(Request $request){
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creator'] = User::with('latestPost')
                        ->orderBy('created_at', 'desc')
                        ->where('name', 'like', "%".$request->search."%")->paginate(9);

            $data['creator']->appends(['search' => $request->search]);
        } else {
            $data['creator'] = User::with('latestPost')->paginate(9);         
        }

        return view('front.home.creator', $data);
    }

    public function creator_detail($username)
    {
        $data['user'] = User::where('username', $username)->first();

        if(auth()->user()){
            if($data['user']->id == auth()->user()->id){
                return redirect()->route('dashboard');
            }
        }else{
            if($data['user']){
                $data['post'] = Post::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->paginate(10);
                $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
        
                return view('front.home.creator_detail', $data);
            }else{
                return redirect()->back();
            }
        }
    }
}
