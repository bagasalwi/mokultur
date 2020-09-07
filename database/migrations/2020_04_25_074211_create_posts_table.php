<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('post_categories');

            $table->string('slug');
            $table->string('title');
            $table->longText('description');
            // $table->string('thumbnail'); // disable - split into post photo gallery
            $table->string('view_count')->nullable();
            $table->string('date_published')->nullable();
            $table->string('status');
            $table->timestamps();   
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
