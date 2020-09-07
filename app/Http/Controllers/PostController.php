<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\PostPhoto;
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

        return view('front.post.post_create', $data)->withTags($tags);
        // if(Post::post() != Auth::user()->id){
        //     return redirect()->back();
        // }else{
        // }
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

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $path = $image->store('images');
            }

            if ($request->status == 'P') {
                $publish_date = Carbon::now();
            } else {
                $publish_date = null;
            }

            $post = Post::create([
                'title' => $request->title,
                'slug' => str_slug($request->title, '-') . str_random(8),
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'view_count' => 0,
                'date_published' => $publish_date,
                'status' => $request->status,
            ]);

            PostPhoto::create([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
                'name' => $path
            ]);

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

            if ($request->hasFile('photo')) {
                $lastImage = asset('storage/' . $post->photo()); // get previous image from folder

                if (File::exists($lastImage)) { // unlink or remove previous image from folder
                    unlink($lastImage);
                }

                $thumbnail = $request->file('thumbnail');
    
                $image = $request->file('photo');
                $path = $image->store('images');

                PostPhoto::where('post_id', $post->id)->update([
                    'user_id' => Auth::user()->id,
                    'post_id' => $post->id,
                    'name' => $path
                ]);
            }

            Post::where('id', $request->id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'date_published' => $request->status == 'P' ? Carbon::now() : null,
                'status' => $request->status,
            ]);

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
        $postPhoto = PostPhoto::where('post_id', $post->id)->first();
        
        DB::table('post_tag')->where('post_id', $post->id)->delete();
        
        $postImage = public_path("gambar/user_post/{$postPhoto->thumbnail}"); // get previous image from folder
        if (File::exists($postImage)) { // unlink or remove previous image from folder
             unlink($postImage);
        }
        
        Post::where('id', $id)->delete();
    }
}
