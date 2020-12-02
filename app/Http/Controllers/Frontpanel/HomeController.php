<?php

namespace App\Http\Controllers\Frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Review;
use App\PostCategory;
use DB;
use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\ReviewServices;

class HomeController extends Controller
{
    
    public function __construct(CategoryServices $categoryService, PostServices $postService, ReviewServices $reviewService)
    {
        $this->postService = $postService;
        $this->reviewService = $reviewService;
        $this->categoryService = $categoryService;
    }

    
    public function index(Request $request)
    {        
        $data['title'] = 'Home';
        $data['top_creation'] = Post::where('status', 'P')->orderBy('view_count', 'desc')->take(5)->get();
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(10);
        $data['review'] = $this->reviewService->takePublishReview(4);
        $data['topCategory'] = $this->categoryService->topCategory();

        return view('front.home', $data);
    }

    public function topic($category = null){
        if($category){
            $data['category'] = $this->categoryService->findSlug($category);
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = $this->postService->postByCategories($data['category']->id);
            
            return view('front.category.category-detail', $data);
        }else{
            $data['category_slide'] = $this->categoryService->categoryTake(5);
            $data['category'] = $this->categoryService->allCategory();
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(10);

            return view('front.category.category', $data);
        }

    }

    public function browse(Request $request){
        $data['creation'] = $this->postService->takePublishPost(9);
        $data['review'] = $this->reviewService->takePublishReview(8);
        $data['topCategory'] = $this->categoryService->topCategory();
    
        return view('front.home.browse', $data);
        
    }
}
