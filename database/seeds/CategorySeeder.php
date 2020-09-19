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
            'slug' => str_slug('Game', '-'),
        ]);
        PostCategory::create([
            'name' => 'Movie',
            'description' => 'All About Movies',
            'slug' => str_slug('Movie', '-'),
        ]);
        PostCategory::create([
            'name' => 'Tutorial',
            'description' => 'All About Tutorial',
            'slug' => str_slug('Tutorial', '-'),
        ]);
        PostCategory::create([
            'name' => 'Design',
            'description' => 'All About Design',
            'slug' => str_slug('Design', '-'),
        ]);
        PostCategory::create([
            'name' => 'Review',
            'description' => 'All About Review',
            'slug' => str_slug('Review', '-'),
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
