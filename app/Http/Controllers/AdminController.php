<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use App\PostCategory;
use App\Post;
use App\Review;
use App\Sidebar;
use Auth;
use DB;
use File;
use Carbon\Carbon;

use App\Services\CategoryServices;


class AdminController extends Controller
{
    public function __construct(CategoryServices $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware(['auth']);
    }

    public function support(){
        $data['title'] = 'Support';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get();  
        
        $data['support'] = DB::table('saran')->get();
   
        return view('back.support_list', $data);
    }

    public function support_delete($id){
        DB::table('saran')->where('id', $id)->delete();
    }

    /*=======================================================*/
    /*===================USER FUCNTION===================*/
    /*=======================================================*/
    public function user(){
        $data['title'] = 'User';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['user'] = User::get();
   
        return view('back.user_list', $data);
    }   

    // public function disable_user($id){
    //     $data['user'] = User::find($id);

    //     if($data['user']){
    //         User::where('id', $data['user']->id)->update([
    //             'status' => 'D'
    //         ]);
    //     }
    // }


    /*=======================================================*/
    /*===================POST FUCNTION===================*/
    /*=======================================================*/
    public function post(){
        $data['title'] = 'Post';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['post'] = Post::get();
        $data['review'] = Review::get();
        dd($data);
   
        return view('back.post_list', $data);
    }
    
    public function post_delete($id){
        $post = Post::where('id', $id)->first();
        
        DB::table('post_tag')->where('post_id', $post->id)->delete();
        
        $usersImage = public_path("gambar/user_post/{$post->thumbnail}"); // get previous image from folder
        if (File::exists($usersImage)) { // unlink or remove previous image from folder
             unlink($usersImage);
        }
        
        Post::where('id', $id)->delete();
    }

    /*==================================================*/
    /*===================TAG FUCNTION===================*/
    /*==================================================*/
    public function tag(){

        $data['title'] = 'Tag';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['tag'] = Tag::get();

        $data['url_create'] = 'admin/tag/create';
        $data['url_delete'] = 'admin/tag/delete';

        return view('back.tag_list', $data);
    }

    public function tag_create(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name
        ]);
        
        return redirect('admin/tag')->with('success', 'Tag baru berhasil ditambahkan!');
    }

    public function tag_delete($id){
        Tag::where('id', $id)->delete();
    }
}
