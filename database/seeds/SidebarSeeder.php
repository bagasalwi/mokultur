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
            'url' => 'admin/user',
            'icon' => 'fas fa-users',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Post',
            'url' => 'admin/post',
            'icon' => 'fas fa-list',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Post Category',
            'url' => 'admin/category',
            'icon' => 'fas fa-tags',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Tag',
            'url' => 'admin/tag',
            'icon' => 'fas fa-tags',
        ]);

        Sidebar::create([
            'role_id' => '2',
            'name' => 'Support',
            'url' => 'admin/support',
            'icon' => 'fas fa-question',
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
