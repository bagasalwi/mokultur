<?php

use Illuminate\Database\Seeder;
use App\PostCategory;
use App\Tag;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCategory::create([
            'name' => 'Game',
            'description' => 'All About Games',
        ]);
        PostCategory::create([
            'name' => 'Movie',
            'description' => 'All About Movies',
        ]);
        PostCategory::create([
            'name' => 'Tutorial',
            'description' => 'All About Tutorial',
        ]);
        PostCategory::create([
            'name' => 'Design',
            'description' => 'All About Design',
        ]);
        PostCategory::create([
            'name' => 'Review',
            'description' => 'All About Review',
        ]);

        Tag::create([
            'name' => 'Review',
        ]);
        Tag::create([
            'name' => 'Game',
        ]);
        Tag::create([
            'name' => 'Movies',
        ]);
        Tag::create([
            'name' => 'Tutorial',
        ]);
        Tag::create([
            'name' => 'Design',
        ]);
    }
}
