<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(10);
        $data['topCategory'] = $this->categoryService->topCategory();

        return view('front.home', $data);
    }

    public function category($category = null){
        $data['title'] = 'Category';

        if($category){
            $data['category'] = $this->categoryService->findSlug($category);
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = Post::where('status', 'P')->where('category_id',$data['category']->id)->orderBy('created_at', 'desc')->paginate(2);
            
            return view('front.category-detail', $data);
        }else{
            $data['category'] = $this->categoryService->allCategory();
            $data['topCategory'] = $this->categoryService->topCategory();
            $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->paginate(2);

            return view('front.category', $data);
        }

    }

    public function contact()
    {        
        $data['title'] = 'Contact';        

        return view('front.home.contact', $data);
    }

    public function contact_submit(Request $request)
    {        
        $data['title'] = 'Contact'; 

        DB::table('saran')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return redirect('contact')->with('success', 'Terima kasih Saran & Kritik anda sangat membantu !');
    }
}
