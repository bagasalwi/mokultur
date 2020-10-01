<?php

namespace App\Http\Controllers\Frontpanel;
use App\Http\Controllers\Controller;

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
use File,Session,DB,Auth,Image;

class BrowseController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function browseArticle(Request $request)
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
}
