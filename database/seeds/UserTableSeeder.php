<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $role_user = Role::where('name', 'user')->first();
    $role_admin  = Role::where('name', 'admin')->first();

    $user = new User();
    $user->name = 'user 1';
    $user->username = 'user1';
    $user->slug = str_slug($user->username, '-');
    $user->email = 'user@user.com';
    $user->password = bcrypt('123456');
    $user->save();
    $user->roles()->attach($role_user);

    $admin = new User();
    $admin->name = 'Bagas Alwi';
    $admin->username = 'bagasalwi';
    $admin->slug = str_slug($user->username, '-');
    $admin->email = 'bagasalwisetyo2@gmail.com';
    $admin->password = bcrypt('bagasalwi');
    $admin->save();
    $admin->roles()->attach($role_admin);
  }
}
