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

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->userService->auth();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post'] = Post::where('user_id', $data['user']->id)->paginate(10);
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

        $time = date("H");
        if ($time < "12") {
            $data['greetings'] = "Good morning";
        } elseif ($time >= "12" && $time < "17") {
            $data['greetings'] = "Good afternoon";
        } elseif ($time >= "17" && $time < "19") {
            $data['greetings'] = "Good evening";
        } elseif ($time >= "19") {
            $data['greetings'] = "Good night";
        }

        return view('front.home.home', $data);
    }

    public function creator(Request $request){
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creator'] = User::with('latestPost')
                        ->orderBy('created_at', 'desc')
                        ->where('name', 'like', "%".$request->search."%")->paginate(9);

            $data['creator']->appends(['search' => $request->search]);
            $data['user'] = Auth::user();
        } else {
            $data['creator'] = User::with('latestPost')->paginate(9);         
            $data['user'] = Auth::user();
        }

        return view('front.home.creator', $data);
    }

    public function creator_detail($username)
    {
        $data['user'] = User::where('username', $username)->first();

        if($data['user']->id == auth()->user()->id){
            return redirect()->route('dashboard');
        }

        if($data['user']){
            $data['post'] = Post::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->paginate(10);
            $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
    
            return view('front.home.creator_detail', $data);
        }else{
            return redirect()->back();
        }
    }

    public function search_creator(Request $request)
    {
        $data['title'] = 'KREATOR';      
        $data['user'] = Auth::user();

        $search = $request->search;
        $data['creator'] = User::with('latestPost')
                        ->orderBy('created_at', 'desc')
                        ->where('name', 'like', "%".$search."%")->paginate(9);

        // dd($data['creator']);
        return view('front.home.creator', $data);
    }
}
