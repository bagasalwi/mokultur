<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\PostPhoto;
use App\Tag;
use App\PostCategory;
use App\Sidebar;
use File, DB, Auth, Image;
use Carbon\Carbon;

use App\Services\PostServices;
use App\Services\CategoryServices;

class PostAdminController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->middleware(['auth']);
    }

    public function post(){
        $data['title'] = 'Post';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['post'] = Post::get();
   
        return view('back.post_list', $data);
    }
    
    public function post_delete($id){
        $post = $this->postService->find($id);

        if($post->type == 'article'){
            $this->postService->deleteImage($id);
            $this->postService->delete($id);
        }elseif($post->type == 'photo'){
            $this->postService->deleteMultipleImage($id);
            $this->postService->delete($id);
        }
        
        Post::where('id', $id)->delete();
    }
}