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
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = $this->postService->userPostCount();

        $data['post'] = $this->postService->allPost(10);

        $data['url_create'] = 'post/create';
        $data['url_update'] = 'post/update';
        $data['url_delete'] = 'post/delete';

        return view('front.post.post_list', $data);
    }

    public function create()
    {
        $data['title'] = 'My Post';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_category'] = PostCategory::get();
        $data['tags2'] = Tag::all();
        $data['post_count'] = $this->postService->userPostCount();

        $tags = array();
        foreach ($data['tags2'] as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        $fields = [
            (object) [
                'id' => 0,
                'user_id' => 0,
                'category_id' => '',
                'title' => '',
                'description' => '',
                'thumbnail' => '',
                'view_count' => '',
                'date_published' => '',
                'status' => '',
                'created_at' => '',
                'updated_at' => '',
            ]
        ];

        $data['fields'] = collect($fields);
        
        $data['state'] = 'create';

        return view('front.post.post_form', $data)->withTags($tags);
    }

    public function update($slug)
    {
        //sidebar
        $data['title'] = 'My Post';
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_category'] = PostCategory::get();
        $data['tags2'] = Tag::all();
        $data['post_count'] = Post::where('user_id', Auth::user()->id)->count();

        $tags = array();
        foreach ($data['tags2'] as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        $data['state'] = 'update';

        $data['fields'] = Post::where('slug', $slug)->get();

        return view('front.post.post_form', $data)->withTags($tags);
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

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        $postPhoto = PostPhoto::where('post_id', $post->id)->first();
        
        DB::table('post_tag')->where('post_id', $post->id)->delete();
        
        $postImage = public_path("gambar/user_post/{$postPhoto->thumbnail}"); // get previous image from folder
        if (File::exists($postImage)) { // unlink or remove previous image from folder
             unlink($postImage);
        }
        
        Post::where('id', $id)->delete();
    }
}
