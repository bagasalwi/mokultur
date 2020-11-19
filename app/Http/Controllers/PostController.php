<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostServices;
use App\User;
use App\Post;
use App\PostPhoto;
use App\Tag;
use App\PostCategory;
use App\Sidebar;
use File, DB, Auth, Image;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct(PostServices $postService)
    {
        $this->postService = $postService;
        $this->middleware(['auth']);
    }

    public function index()
    {
        $data['title'] = 'My Post';
        $data['user'] = Auth::user();
        // $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = $this->postService->userPostCount();

        $data['post'] = $this->postService->allPostUser(5);

        $data['url_create'] = 'post/create';
        $data['url_update'] = 'post/update';
        $data['url_delete'] = 'post/delete';

        return view('front.post.post_list', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'My Post';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_category'] = PostCategory::get();
        $data['post_count'] = $this->postService->userPostCount();

        $data['fields'] = new Post;
        
        $data['state'] = 'create';

        if($request->type == 'photo'){
            $data['type'] = 'photo';
            return view('front.post.post_photo_form', $data);
        }elseif($request->type == 'article'){
            $data['type'] = 'article';
            return view('front.post.post_form', $data);
        }
    }

    public function update($slug)
    {
        $post = Post::where('slug', $slug)->first();
        
        if($post->user_id == auth()->user()->id){
            $data['title'] = 'My Post';
            $data['sidebar'] = Sidebar::where('role_id', 1)->get();
            $data['post_category'] = PostCategory::get();

            $data['post_count'] = Post::where('user_id', Auth::user()->id)->count();
            
            $data['state'] = 'update';
            $data['fields'] = $this->postService->find($post->id);

            $data['tags'] = $post->tagNames();

            if($post->type == 'photo'){
                $data['type'] = 'photo';
                $data['post_image'] = PostPhoto::where('post_id',$post->id)->get();

                return view('front.post.post_photo_form', $data);
            }elseif($post->type == 'article'){
                $data['type'] = 'article';

                return view('front.post.post_form', $data);
            }
        }else{
            return redirect()->route('post.create');
        }
    }

    public function save(Request $request)
    {
        if ($request->state == 'create') {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'photo' => 'file|image|mimes:jpeg,png,jpg|required',
                'status' => 'required',
            ]);
                
            $post = $this->postService->create($request->all());

            if ($request->hasFile('photo')) {
                $this->postService->createImage($post->id,$request->file('photo'));
            }

            return redirect('post')->with('success', 'Post baru berhasil dibuat!');
        }
        
        if ($request->state == 'update') {

            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'photo' => 'file|image|mimes:jpeg,png,jpg',
                'status' => 'required',
            ]);

            $this->postService->update($request->all());

            $post = $this->postService->find($request->id);

            if ($request->hasFile('photo')) {
                $this->postService->updateImage($post->id,$request->file('photo'));
            }

            return redirect('post')->with('success', 'Post berhasil di update!');
        }
    }

    public function savePhoto(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'photo.*' => 'file|image|mimes:jpeg,png,jpg|required',
            'status' => 'required',
        ]);

        if($request->state == 'create'){
            $post = $this->postService->create($request->all());

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');

                $this->postService->createMultipleImage($post->id,$image);
            }

            return redirect('post')->with('success', 'Post baru berhasil dibuat!');
        }elseif($request->state == 'update'){
            $post = $this->postService->update($request->all());

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');

                $this->postService->updateMultipleImage($post->id,$image);
            }

            return redirect('post')->with('success', 'Post berhasil di update!');
        }
    }

    public function delete($id)
    {
        $post = $this->postService->find($id);

        if($post->type == 'article'){
            $this->postService->deleteImage($id);
            $this->postService->delete($id);
        }elseif($post->type == 'photo'){
            $this->postService->deleteMultipleImage($id);
            $this->postService->delete($id);
        }
    }

    public function ajaxTags(Request $request){
        if($request->has('q')){
            $search = $request->q;
            $data = Tag::select('id','name')->where('name', 'like', "%".$search."%")->get();

            return response()->json($data);
        }
    }
}
