<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
  public function run()
  {
    $role_user = new Role();
    $role_user->name = 'user';
    $role_user->description = 'a default user';
    $role_user->save();

    $role_admin = new Role();
    $role_admin->name = 'admin';
    $role_admin->description = 'an admin user';
    $role_admin->save();
  }
}
