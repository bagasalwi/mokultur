<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Post;
use File, DB, Auth, Image;
use Carbon\Carbon;

class UserServices
{
    // Creator is basicly a registered user
    public function model()
    {
        return User::all();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function auth()
    {
        return Auth::user();
    }

    public function userCount()
    {
        return User::count();
    }

    public function updateProfile($request, $image = null)
    {
        $user = $this->auth();

        if ($image) {
            if ($user->profile_pic !== 'images/profile/user-default.png') {
                $lastImage = public_path('storage/' . $user->profile_pic); // get previous image from folder

                if (File::exists($lastImage)) { // unlink or remove previous image from folder
                    unlink($lastImage);
                }

                $path = $image->store('images/profile');
                $user->profile_pic = $path;
            } else {
                $path = $image->store('images/profile');
                $user->profile_pic = $path;
            }
        }

        $user->name = $request['name'];
        // $user->email = $request['email'];
        $user->username = $request['username'];
        $user->slug = str_slug($request['username'], '-');
        $user->description = $request['description'];
        $user->instagram = $request['instagram'];
        $user->facebook = $request['facebook'];
        $user->save();

        return $user;
    }

    public function updatePassword($request){
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->password = Hash::make($request['new_password']);
        $user->save();
    }
}
