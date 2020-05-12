<?php

use Illuminate\Database\Seeder;
use App\PostCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCategory::create(
        [
            'name' => 'Game',
            'description' => 'All About Games',
        ],
        [
            'name' => 'Movie',
            'description' => 'All About Movies',
        ],
        [
            'name' => 'Design',
            'description' => 'All About Design',
        ]);
    }
}
