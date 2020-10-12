<?php

namespace App\Http\Controllers;

use App\User;
use App\Sidebar;
use App\Post;
use App\Rules\MatchOldPassword;

use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\UserServices;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class ProfileController extends Controller
{
    public function __construct(CategoryServices $categoryService, PostServices $postService, UserServices $userService)
    {
        $this->middleware(['auth']);
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->userService->auth();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = $this->postService->postCountAuth($data['user']->id);
        
        return view('front.profile.profile', $data);
    }
    
    public function dashboard(){
        $data['user'] = $this->userService->auth();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post'] = Post::where('user_id', $data['user']->id)->paginate(10);
        $data['total_post'] = auth()->user()->totalPost();
        $data['active_since'] = auth()->user()->created_at->format('d M Y');

        $data['total_view'] = 0;
        if($data['post']){
            foreach($data['post'] as $post){
                $data['total_view'] += $post->view_count;
            }
        }

        $time = date("H");
        if ($time < "12") {
            $data['greetings'] = "Good morning";
        } elseif ($time >= "12" && $time < "17") {
            $data['greetings'] = "Good afternoon";
        } elseif ($time >= "17" && $time < "19") {
            $data['greetings'] = "Good evening";
        } elseif ($time >= "19") {
            $data['greetings'] = "Good night";
        }

        return view('front.home.home', $data);
    }

    public function save(Request $request)
    {
        $user = $this->userService->auth();

        $this->validate($request, [
            'name' => 'required|min:3',
            // 'email' => 'required|email|unique:users,email,'. $user->id,
            'username' => 'required|min:3|max:10|unique:users,username,'. $user->id,
            'profile_pic' => 'file|image|mimes:jpeg,png,jpg',
        ]);

        $this->userService->updateProfile($request->all(),$request->file('profile_pic'));

        return redirect('profile')->with(['success' => 'Profil kamu berhasil di update!']);
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password']
        ]);

        $this->userService->updatePassword($request->all());

        return redirect('profile')->with(['success' => 'Password berhasil di update!']);
    }
}
