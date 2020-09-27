<?php

namespace App\Http\Controllers;

use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Post;
use App\PostCategory;
use App\User;
use App\Sidebar;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use File;
use DB;
use Auth;
use Image;
use Session;

class CreationController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

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

    public function creation(Request $request)
    {
        if ($request->ajax()) {
            $output= array();
            $post = Post::where('status', 'P')
                    ->orderBy('created_at', 'desc')
                    ->where('title', 'like', "%".$request->search."%")->get();

            if ($post) {
                foreach ($post as $p) {
                    $desc = strlen($p->description) > 100 ? substr($p->description, 0, 150) . '...' : $p->description;

                    $output[] = '<div class="card border-0 my-4">
                        <div class="row">
                            <div class="col-4">
                                <img class="img-cover" width="255" height="180" src="'. asset('storage/' . $p->photo())   .'" alt="">
                            </div>
                            <div class="col-8">
                                <h4><a class="text-dark" href="'. url('creation/' . $p->slug) .'">'. $p->title .'</a></h4>
                                <div class="text-secondary no-pm" data-font-size="14px">'. $desc .'</div>
                                <div class="row">
                                    <div class="col-6 d-flex flex-row">
                                        <div class="align-items-end">
                                            <p class="text-secondary" data-font-size="12px">
                                                '. Carbon::parse($p->date_published)->diffForHumans() .' &middot; <a
                                                    href="'. url('creator/' . $p->user->username) .'">'. strtoupper($p->user->name) .'</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex flex-row-reverse">
                                        <div class="align-self-end">
                                            <a href="'. url('creation/' . $p->slug) .'" class="btn btn-outline-dark m-0">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>';
                }
                return response($output);
            }
        } elseif ($request->has('search')) {
            $data['title'] = 'KREASI';
            $data['search_meta'] = $request->search;
            $data['creation'] = Post::where('status', 'P')
                                ->orderBy('created_at', 'desc')
                                ->where('title', 'like', "%".$request->search."%")->paginate(10);
            $data['topCategory'] = $this->categoryService->topCategory();

            return view('front.home.creation', $data);
        } else {
            $data['title'] = 'KREASI';
            $data['creation'] = $this->postService->latestPublishedPost(10);
            $data['topCategory'] = $this->categoryService->topCategory();
            
            return view('front.home.creation', $data);
        }
    }

    public function creation_detail($slug)
    {
        $data['title'] = 'KREASI';
        $data['post'] = Post::where('slug', $slug)->first();
        $data['user'] = User::where('id', $data['post']->user_id)->first();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
        $data['recomendation'] = Post::where('category_id', $data['post']->category_id)->take(3)->get()->except($data['post']->id);

        if ($data['post']) {
            Post::where('id', $data['post']->id)->increment('view_count');

            return view('front.home.creation_detail', $data);
        } else {
            return redirect()->back();
        }
    }

    public function category_creation($name)
    {
        $data['title'] = 'KREASI';
        
        if ($name == 'all') {
            $data['post'] = Post::orderBy('created_at', 'desc')->paginate(6);
        } else {
            $post = PostCategory::where('name', $name)->first();
            $data['post'] = Post::where('category_id', $post->id)->where('status', 'P')->orderBy('created_at', 'desc')->paginate(6);
        }

        $data['name'] = $name;
        $data['category'] = PostCategory::get();

        return view('front.home.creation_category', $data);
    }
}
