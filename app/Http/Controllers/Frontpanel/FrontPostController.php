<?php

namespace App\Http\Controllers\Frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\ReviewServices;
use App\Services\UserServices;
use App\Post;
use App\Review;
use App\User;
use Carbon\Carbon;
use File, DB, Auth, Image, Session;

class FrontPostController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService, ReviewServices $reviewService)
    {
        $this->postService = $postService;
        $this->reviewService = $reviewService;
        $this->categoryService = $categoryService;
    }

    public function browsePost(Request $request)
    {
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creation'] = Post::where('status', 'P')
                ->orderBy('created_at', 'desc')
                ->where('title', 'like', "%" . $request->search . "%")->paginate(8);

            $data['creation']->appends(['search' => $request->search]);

            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();
        } else {
            $data['creation'] = $this->postService->latestPublishedPost(8);
            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();
        }
        return view('front.home.browse-post', $data);
    }

    public function browseTag(Request $request){
        if ($request->has('tag')) {
            $data['post'] = Post::withAnyTag($request->tag)->paginate(8, ['*'], 'article');
            $data['review'] = Review::withAnyTag($request->tag)->paginate(9, ['*'], 'review');
            $data['post']->appends(['tag' => $request->tag]);
            $data['review']->appends(['tag' => $request->tag]);
        }
        
        $data['all_tags'] = \Conner\Tagging\Model\Tag::get();
        $data['top_category'] = $this->categoryService->topCategory();
        $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();

        return view('front.home.browse-tag',$data);
    }

    public function browseReview(Request $request)
    {
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['review'] = Review::where('status', 'P')
                ->orderBy('created_at', 'desc')
                ->where('title', 'like', "%" . $request->search . "%")->paginate(8);

            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();
        } else {
            $data['review'] = $this->reviewService->latestPublishedReview(8);
            $data['top_category'] = $this->categoryService->topCategory();
            $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();
        }
        return view('front.home.browse-review', $data);
    }

    public function previewDetailPost($slug)
    {
        if (auth()->user()) {
            $data['post'] = $this->postService->draftedDetailPost($slug);
            if ($data['post']->user_id == auth()->user()->id) {
                $data['user'] = User::where('id', $data['post']->user_id)->first();

                $data['post_image'] = $data['post']->images()->get();
                $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

                $data['recomendation'] = Post::where('category_id', $data['post']->category_id)->take(3)->get()->except($data['post']->id);

                $words = str_word_count(strip_tags($data['post']->description));
                $minutes = floor($words / 120);
                $data['estimated_time'] = $minutes . ' minute' . ($minutes == 1 ? '' : 's');

                Post::where('id', $data['post']->id)->increment('view_count');

                return view('front.home.creation_detail', $data);
            }
        } else {
            return redirect('/');
        }
    }

    public function publishDetailPost($username, $slug)
    {
        $data['top_category'] = $this->categoryService->topCategory();
        $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();
        $data['user'] = User::where('username', $username)->first();
        if ($data['user']) {
            $data['post'] = $this->postService->publishedDetailPost($slug);
            $data['post_image'] = $data['post']->images()->get();
            $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

            $data['recomendation'] = Post::where('category_id', $data['post']->category_id)->take(3)->get()->except($data['post']->id);

            $words = str_word_count(strip_tags($data['post']->description));
            $minutes = floor($words / 120);
            $data['estimated_time'] = $minutes . ' minute' . ($minutes == 1 ? '' : 's');

            $data['meta_tags'] = $data['post']->tagNames();

            Post::where('id', $data['post']->id)->increment('view_count');

            return view('front.home.article_detail', $data);
        } else {
            return redirect()->back();
        }
    }

    // public function postChecker($slug)
    // {
    //     $statusChecker = $this->postService->postStatusChecker($slug);

    //     if ($statusChecker) {
    //         if ($statusChecker == 'DRAFT') {
    //            return $this->previewDetailPost($slug);
    //         } elseif ($statusChecker == 'PUBLISH') {
    //            return $this->publishDetailPost($slug);
    //         }
    //     } else {
    //         return redirect('/');
    //     }
    // }

    public function reviewDetail($username, $slug)
    {
        $data['user'] = User::where('username', $username)->first();
        $data['review'] = $this->reviewService->publishedDetailReview($slug);

        $data['top_category'] = $this->categoryService->topCategory();
        $data['top_tags'] = \Conner\Tagging\Model\Tag::orderBy('count','desc')->take(5)->get();

        $words = str_word_count(strip_tags($data['review']->content));
        $minutes = floor($words / 120);
        $data['estimated_time'] = $minutes . ' minute' . ($minutes == 1 ? '' : 's');

        return view('front.home.review_detail', $data);
    }
}
