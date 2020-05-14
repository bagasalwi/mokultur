<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tag;
use App\PostCategory;
use App\Sidebar;
use File;
use DB;
use Auth;
use Image;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $data['title'] = 'My Post';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

        $data['post'] = Post::where('user_id', Auth::user()->id)->paginate(5);
        
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
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

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

        return view('front.post.post_create', $data)->withTags($tags);
    }

    public function update($slug)
    {
        //sidebar
        $data['title'] = 'My Post';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_category'] = PostCategory::get();
        $data['tags2'] = Tag::all();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();

        $tags = array();
        foreach ($data['tags2'] as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        $data['state'] = 'update';

        $post = Post::where('slug', $slug)->first();
        $data['fields'] = Post::where('slug', $slug)->get();

        if($post->user_id != Auth::user()->id){
            return redirect('home');
        }else{
            return view('front.post.post_update', $data)->withTags($tags);
        }

    }

    public function save(Request $request)
    {
        if ($request->state == 'create') {

            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'thumbnail' => 'file|image|mimes:jpeg,png,jpg|required',
                'status' => 'required',
            ]);

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
    
                $filename = time() . '.' . $image->getClientOriginalExtension();
    
                Image::make($image)->save(public_path('gambar/user_post/' . $filename));
            }

            if ($request->status == 'P') {
                $publish_date = Carbon::now();
            } else {
                $publish_date = null;
            }

            $post = new Post;

            $post->title = $request->title;
            $post->slug = str_slug($request->title, '-') . str_random(8);
            $post->user_id = Auth::user()->id;
            $post->category_id = $request->category_id;
            $post->description = $request->description;
            $post->thumbnail = $filename;
            $post->view_count = 0;
            $post->date_published = $publish_date;
            $post->status = $request->status;

            $post->save();

            $post->tags()->sync($request->tags, false);

            return redirect('post')->with('success', 'Post baru berhasil dibuat!');
        }
        
        if ($request->state == 'update') {

            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'thumbnail' => 'file|image|mimes:jpeg,png,jpg',
                'status' => 'required',
            ]);
            
            $post = Post::find($request->id);

            if ($request->hasFile('thumbnail')) {
                $post = Post::where('id', $request->id)->first();

                $postImage = public_path("gambar/user_post/{$post->thumbnail}"); // get previous image from folder
                if (File::exists($postImage)) { // unlink or remove previous image from folder
                    unlink($postImage);
                }

                $thumbnail = $request->file('thumbnail');
    
                $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
    
                Image::make($thumbnail)->save(public_path('gambar/user_post/' . $filename));
                $post->thumbnail = $filename;
            }

            if ($request->status == 'P') {
                $publish_date = Carbon::now();
            } else {
                $publish_date = null;
            }

            $post->title = $request->title;
            // $post->slug = str_slug($request->title, '-') . str_random(8);
            $post->user_id = Auth::user()->id;
            $post->category_id = $request->category_id;
            $post->description = $request->description;
            $post->date_published = $publish_date;
            $post->status = $request->status;

            $post->save();

            if (isset($request->tags)) {
                $post->tags()->sync($request->tags);
            } else {
                $post->tags()->sync(array());
            }

            return redirect('post')->with('success', 'Post berhasil di update!');
        }
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        
        DB::table('post_tag')->where('post_id', $post->id)->delete();
        // dd($post_tag);
        
        $usersImage = public_path("gambar/user_post/{$post->thumbnail}"); // get previous image from folder
        if (File::exists($usersImage)) { // unlink or remove previous image from folder
             unlink($usersImage);
        }
        
        Post::where('id', $id)->delete();
    }
}
