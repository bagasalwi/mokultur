<?php

namespace App\Http\Controllers\Frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use DB;
use App\Services\CategoryServices;
use App\Services\PostServices;

class HomeController extends Controller
{
    
    public function __construct(CategoryServices $categoryService, PostServices $postService)
    {
        $this->postService = $postService;
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

    public function specialCategory(){

        $data['category'] = PostCategory::first();
        $data['topCategory'] = $this->categoryService->topCategory();
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(8);
        
        return view('front.special.category-special', $data);
    }
}
