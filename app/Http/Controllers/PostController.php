<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\PostServices;
use App\User;
use App\Post;
use App\PostPhoto;
use App\Tag;
use App\PostCategory;
use App\Sidebar;

use App\Rules\ContainBadWords;

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

        if ($request->tipe_post == 'photo') {
            $data['tipe_post'] = 'photo';
            return view('front.post.post_photo_form', $data);
        } elseif ($request->tipe_post == 'article') {
            $data['tipe_post'] = 'article';
            return view('front.post.post_form', $data);
        }
    }

    public function update($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if ($post->user_id == auth()->user()->id) {
            $data['title'] = 'My Post';
            $data['sidebar'] = Sidebar::where('role_id', 1)->get();
            $data['post_category'] = PostCategory::get();

            $data['post_count'] = Post::where('user_id', Auth::user()->id)->count();

            $data['state'] = 'update';
            $data['fields'] = $this->postService->find($post->id);

            $data['tags'] = $post->tagNames();

            if ($post->tipe_post == 'photo') {
                $data['tipe_post'] = 'photo';
                $data['post_image'] = PostPhoto::where('post_id', $post->id)->get();

                return view('front.post.post_photo_form', $data);
            } elseif ($post->tipe_post == 'article') {
                $data['tipe_post'] = 'article';

                return view('front.post.post_form', $data);
            }
        } else {
            return redirect()->route('post.create');
        }
    }

    public function save(Request $request)
    {
        // $str = 'Sequel, Prequel, Remake, Reboot & Spin Off Perbedaannya?';
        // $arr = file(public_path('wordlist/badword.list'), FILE_IGNORE_NEW_LINES);

        // dd(Str::contains($str, $arr));

        if ($request->state == 'create') {
            $this->validate($request, [
                'title' => ['required', new ContainBadWords],
                'slug' => 'unique:posts,slug',
                'category_id' => 'required',
                'description' => 'required',
                'tags.*' => new ContainBadWords,
                'photo' => 'file|image|mimes:jpeg,png,jpg|required',
                'status' => 'required',
            ]);

            $post = $this->postService->create($request->all());

            if ($request->hasFile('photo')) {
                $this->postService->createImage($post->id, $request->file('photo'));
            }

            return redirect('post')->with('success', 'Post baru berhasil dibuat!');
        }

        if ($request->state == 'update') {

            $this->validate($request, [
                'title' => ['required', new ContainBadWords()],
                'slug' => 'unique:posts,slug,' . $request->id,
                'category_id' => 'required',
                'description' => ['required'],
                'photo' => 'file|image|mimes:jpeg,png,jpg',
                'status' => 'required',
            ]);

            $this->postService->update($request->all());

            $post = $this->postService->find($request->id);

            if ($request->hasFile('photo')) {
                $this->postService->updateImage($post->id, $request->file('photo'));
            }

            return redirect('post')->with('success', 'Post berhasil di update!');
        }
    }

    public function savePhoto(Request $request)
    {
        // dd($request->file());

        // dd($request->file());

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'photo.*' => 'file|image|mimes:jpeg,png,jpg|required',
            'status' => 'required',
        ]);

        if ($request->state == 'create') {
            $post = $this->postService->create($request->all());

            if ($request->file()) {
                $image = $request->file();
                $order = $request->order_photo;

                $this->postService->createMultipleImage($post->id, $image, $order);
            }

            return redirect('post')->with('success', 'Post baru berhasil dibuat!');
        } elseif ($request->state == 'update') {
            $post = $this->postService->update($request->all());

            $order = $request->order_photo;
            $order_delete = explode(',', $request->order_delete);
            asort($order_delete);

            $image = $request->file() ? $request->file() : null;

            // $cover_image = [];
            // foreach ($image as $i => $ih) {  
            //     foreach($ih as $key => $k){
            //         array_push($cover_image,[
            //             'file' => $k,
            //             'order' => $key+1 != $order[$key] ? $order[$key] : $key,
            //             'image_id' => $key+1
            //         ]);  
            //     }
            // }
            // dd($cover_image);

            $this->postService->updateMultipleImage($post->id, $image, $order_delete);

            return redirect('post')->with('success', 'Post berhasil di update!');
        }
    }

    public function delete($id)
    {
        $post = $this->postService->find($id);

        if ($post->tipe_post == 'article') {
            $this->postService->deleteImage($id);
            $this->postService->delete($id);
        } elseif ($post->tipe_post == 'photo') {
            $this->postService->deleteMultipleImage($id);
            $this->postService->delete($id);
        }
    }

    public function ajaxTags(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = Tag::select('id', 'name')->where('name', 'like', "%" . $search . "%")->get();

            return response()->json($data);
        }
    }
}
