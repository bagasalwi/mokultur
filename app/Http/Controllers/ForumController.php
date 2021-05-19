<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forum;
use App\ForumTag;
use App\Comment;
use App\User;
use App\Services\UserServices;
use Carbon\Carbon;
use File, DB, Auth, Image, Session;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $data['forum'] = Forum::get();
        
        // dd($data);
        return view('front.forum.index',$data);
    }
    
    public function view($slug){
        $data['forum'] = Forum::where('slug', $slug)->first();
        
        return view('front.forum.detail',$data);
    }


}
