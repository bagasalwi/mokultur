<?php

namespace App\Http\Controllers;

use App\User;
use App\Sidebar;
use App\Post;
use App\Review;
use App\Rules\MatchOldPassword;

use App\Services\CategoryServices;
use App\Services\PostServices;
use App\Services\ReviewServices;
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

    public function getGreets(){
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

        return $data['greetings'];
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->userService->auth();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = $this->postService->postCountAuth($data['user']->id);
        
        return view('front.profile.profile', $data);
    }
    
    public function dashboard($type = null){
        $data['user'] = $this->userService->auth();
        $data['active_since'] = auth()->user()->created_at->format('d M Y');
        $data['greetings'] = $this->getGreets();

        if($type == null || $type == 'article'){
            $data['post'] = Post::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->paginate(9);
            $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
            $data['total_post'] = $data['user']->totalPost();

            return view('front.profile.dashboard-article', $data);
        }else if($type == 'review'){
            $data['review'] = Review::orderBy('created_at', 'desc')->where('user_id', $data['user']->id)->paginate(12);
            $data['review_count'] = Review::where('user_id', $data['user']->id)->count();
            $data['total_review'] = $data['user']->totalReview();

            return view('front.profile.dashboard-review', $data);
        }else{
            return redirect()->back();
        }
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
