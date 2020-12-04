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
            'name' => 'Games',
            'description' => 'All About Games',
            'slug' => str_slug('Game', '-'),
        ]);
        PostCategory::create([
            'name' => 'Movies',
            'description' => 'All About Movies',
            'slug' => str_slug('Movie', '-'),
        ]);
        PostCategory::create([
            'name' => 'Design',
            'description' => 'All About Design',
            'slug' => str_slug('Design', '-'),
        ]);
        PostCategory::create([
            'name' => 'Anime',
            'description' => 'All About Anime',
            'slug' => str_slug('Anime', '-'),
        ]);
        PostCategory::create([
            'name' => 'Technology',
            'description' => 'All About Technology',
            'slug' => str_slug('Technology', '-'),
        ]);
        PostCategory::create([
            'name' => 'Pop Culture',
            'description' => 'All About Pop Culture',
            'slug' => str_slug('Pop Culture', '-'),
        ]);
        PostCategory::create([
            'name' => 'Geeks',
            'description' => 'All About Geek',
            'slug' => str_slug('Geek', '-'),
        ]);
        PostCategory::create([
            'name' => 'Programming',
            'description' => 'All About Programming',
            'slug' => str_slug('Programming', '-'),
        ]);
        PostCategory::create([
            'name' => 'Stories',
            'description' => 'All About Story',
            'slug' => str_slug('Story', '-'),
        ]);
        PostCategory::create([
            'name' => 'Foodies',
            'description' => 'All About Foodies',
            'slug' => str_slug('Foodies', '-'),
        ]);

    }
}
