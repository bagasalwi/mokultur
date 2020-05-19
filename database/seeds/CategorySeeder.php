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
            'name' => 'Review',
            'description' => 'All About Review',
        ],
        [
            'name' => 'Tutorial',
            'description' => 'All About Tutorial',
        ],
        [
            'name' => 'Design',
            'description' => 'All About Design',
        ]);

        Tag::create(
            [
                'name' => 'Game',
            ],
            [
                'name' => 'Review',
            ],
            [
                'name' => 'Tutorial',
            ],
            [
                'name' => 'Design',
            ],
            [
                'name' => 'Movie',
            ],
        );
    }
}
