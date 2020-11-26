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
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(8);
        $data['topCategory'] = $this->categoryService->topCategory();

        return view('front.home', $data);
    }

    public function category($category = null){
        if($category){
            $data['category'] = $this->categoryService->findSlug($category);
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = $this->postService->postByCategories($data['category']->id);
            
            return view('front.category.category-detail', $data);
        }else{
            $data['category_slide'] = $this->categoryService->categoryTake(5);
            $data['category'] = $this->categoryService->allCategory();
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(2);

            return view('front.category.category', $data);
        }

    }

    public function browse(Request $request){

        if ($request->has('search')) {
            $data['search_meta'] = $request->search;
            $data['creation'] = Post::where('status', 'P')
                ->orderBy('created_at', 'desc')
                ->where('title', 'like', "%" . $request->search . "%")->paginate(8);

            $data['creation']->appends(['search' => $request->search]);

            $data['review'] = Review::where('status', 'P')
                ->orderBy('created_at', 'desc')
                ->where('title', 'like', "%" . $request->search . "%")->paginate(8);

            $data['topCategory'] = $this->categoryService->topCategory();
        } else {
            $data['creation'] = $this->postService->takePublishPost(5);
            $data['review'] = $this->reviewService->takePublishReview(5);
            $data['topCategory'] = $this->categoryService->topCategory();
        }
        return view('front.home.browse', $data);
        
    }
}
