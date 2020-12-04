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

    $admin = new User();
    $admin->name = 'Bagas Alwi';
    $admin->username = 'bagasalwi';
    $admin->slug = str_slug($admin->username, '-');
    $admin->email = 'bagasalwisetyo2@gmail.com';
    $admin->password = bcrypt('bagasalwi');
    $admin->save();
    $admin->roles()->attach($role_admin);
  }
}
