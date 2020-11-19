<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('review_name');
            $table->string('review_image');
            $table->string('review_synopsis');
            $table->string('review_releasedate');
            $table->string('review_genre')->nullable();
            $table->string('review_studio')->nullable();
            $table->string('review_link')->nullable();
            
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->integer('score');
            $table->longText('recommend')->nullable();
            $table->longText('unrecommend')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
