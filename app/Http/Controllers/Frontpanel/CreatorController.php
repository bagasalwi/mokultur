<?php

namespace App\Http\Controllers\Frontpanel;

use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\ReviewServices;
use App\Services\UserServices;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Review;
use App\Sidebar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth, DB, Image, File, Session;

class CreatorController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService, ReviewServices $reviewService, UserServices $userService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
        $this->reviewService = $reviewService;
        $this->top_tags = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(3)->get();
    }

    public function creator(Request $request)
    {
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creator'] = User::with('latestPost')
                ->orderBy('created_at', 'desc')
                ->where('name', 'like', "%" . $request->search . "%")->paginate(9);

            $data['creator']->appends(['search' => $request->search]);
            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = $this->top_tags;
        } else {
            $data['creator'] = User::with('latestPost')->paginate(9);
            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = $this->top_tags;
        }

        return view('front.creator.creator', $data);
    }

    public function creator_detail(Request $request, $username, $type = null)
    {
        $data['user'] = User::where('username', $username)->first();

        $type = $request->type;

        if ($data['user']) {
            $data['active_since'] = $data['user']->created_at->format('d M Y');
            if ($type == 'article' || $type == '') {
                $data['post'] = Post::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->where('status','P')->paginate(9);
                $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
                $data['total_post'] = $data['user']->totalPost();

                $data['total_view'] = 0;
                if ($data['post']) {
                    foreach ($data['post'] as $post) {
                        $data['total_view'] += $post->view_count;
                    }
                }

                return view('front.creator.creator-post', $data);
            }elseif($type == 'review'){
                $data['review'] = Review::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->where('status','P')->paginate(12);
                $data['review_count'] = Review::where('user_id', $data['user']->id)->count();
                $data['total_review'] = $data['user']->totalReview();

                return view('front.creator.creator-review', $data);
            }else{
                return redirect('/');
            }
        } else {
            return redirect()->back();
        }
    }
}
