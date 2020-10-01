<?php

namespace App\Http\Controllers\Frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Post;
use App\User;
use Carbon\Carbon;
use File,DB,Auth,Image,Session;

class FrontPostController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function post(Request $request)
    {
        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creation'] = Post::where('status', 'P')
                ->orderBy('created_at', 'desc')
                ->where('title', 'like', "%" . $request->search . "%")->paginate(2);

            $data['creation']->appends(['search' => $request->search]);

            $data['topCategory'] = $this->categoryService->topCategory();
        } else {
            $data['creation'] = $this->postService->latestPublishedPost(2);
            $data['topCategory'] = $this->categoryService->topCategory();
        }
        return view('front.home.creation', $data);
    }

    public function post_detail($slug)
    {
        $data['title'] = 'KREASI';
        $data['post'] = Post::where('slug', $slug)->first();
        $data['user'] = User::where('id', $data['post']->user_id)->first();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
        $data['recomendation'] = Post::where('category_id', $data['post']->category_id)->take(3)->get()->except($data['post']->id);

        $words = str_word_count( strip_tags( $data['post']->description ) );
        $minutes = floor( $words / 120 );
        $seconds = floor( $words % 120 / ( 120 / 60 ) );

        if ( 1 <= $minutes ) {
            $data['estimated_time'] = $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ', ' . $seconds . ' second' . ($seconds == 1 ? '' : 's');
        } else {
            $data['estimated_time'] = $seconds . ' second' . ($seconds == 1 ? '' : 's');
        }

        if ($data['post']) {
            Post::where('id', $data['post']->id)->increment('view_count');

            return view('front.home.creation_detail', $data);
        } else {
            return redirect()->back();
        }
    }
}
