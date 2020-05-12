<?php

namespace App\Http\Controllers;

use App\User;
use App\Sidebar;
use App\Post;
use App\Rules\MatchOldPassword;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Auth;
use DB;
use Image;
use File;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();
        $data['post_count'] = Post::where('user_id', $data['user']->id)->count();
        
        return view('front.profile.profile', $data);
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'username' => 'required|min:3|max:10|unique:users,username,'. $user->id,
            'profile_pic' => 'file|image|mimes:jpeg,png,jpg',
            ]);


        if ($request->hasFile('profile_pic')) {
            $avatar = $request->file('profile_pic');
            

            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($user->profile_pic !== null && $user->profile_pic !== 'default.png') {
                $usersImage = public_path('gambar/profile_pic/' . $user->profile_pic); // get previous image from folder
                if (File::exists($usersImage)) { // unlink or remove previous image from folder
                    unlink($usersImage);
                }
            }

            Image::make($avatar)->save(public_path('gambar/profile_pic/' . $filename));
            $user->profile_pic = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->slug = str_slug($request->username, '-');
        $user->description = $request->description;
        $user->instagram = $request->instagram;
        $user->facebook = $request->facebook;
        $user->save();

        return redirect('profile')->with(['success' => 'Profil kamu berhasil di update!']);
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password']
        ]);

        $id = Auth::user()->id;
        $user = User::find($id);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('profile')->with(['success' => 'Password berhasil di update!']);
    }
}
