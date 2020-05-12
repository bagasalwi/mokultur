<?php

use Illuminate\Database\Seeder;
use App\Sidebar;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sidebar::create([
            'role_id' => '2',
            'name' => 'User',
            'url' => 'user',
            'icon' => 'fas fa-users',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Post',
            'url' => 'post-admin',
            'icon' => 'fas fa-list',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Post Category',
            'url' => 'post-category',
            'icon' => 'fas fa-tags',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Tag',
            'url' => 'tag',
            'icon' => 'fas fa-tags',
        ]);

        Sidebar::create([
            'role_id' => '1',
            'name' => 'Home',
            'url' => 'home',
            'icon' => 'fas fa-home',
        ]);

        Sidebar::create([
            'role_id' => '1',
            'name' => 'My Profile',
            'url' => 'profile',
            'icon' => 'fas fa-home',
        ]);

        Sidebar::create([
            'role_id' => '1',
            'name' => 'My Post',
            'url' => 'post',
            'icon' => 'fas fa-post',
        ]);
    }
}
