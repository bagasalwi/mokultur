<?php

namespace App\Http\Controllers;

use App\Post;
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

class CreatorController extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post'] = Post::where('user_id', $data['user']->id)->paginate(10);
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

        return view('front.home.home', $data);
    }

    public function creator(){
        $data['title'] = 'KREATOR';
        $data['creator'] = User::with('latestPost')->paginate(9);         
        $data['user'] = Auth::user();

        return view('front.home.creator', $data);
    }

    public function creator_detail($username)
    {
        $data['title'] = 'KREATOR';
        $data['user'] = User::where('username', $username)->first();

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
