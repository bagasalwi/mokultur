<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Frontpanel\HomeController@index')->name('home');
Route::get('/special', 'Frontpanel\HomeController@special')->name('special');

Route::prefix('/genshin')->group(function (){
    Route::get('/', 'Frontpanel\GenshinController@index')->name('genshin');
    Route::get('/characters', 'Frontpanel\GenshinController@characters');
    Route::get('/characters/{name}', 'Frontpanel\GenshinController@characters');
    Route::get('/artifacts', 'Frontpanel\GenshinController@artifacts')->name('genshin.artifacts');
});

Route::prefix('topic')->group(function () {
    Route::get('/', 'Frontpanel\HomeController@topic')->name('topic');
    Route::get('/{category}', 'Frontpanel\HomeController@topic')->name('topic.detail');
});

Route::prefix('browse')->group(function () {
    Route::get('/', 'Frontpanel\HomeController@browse')->name('browse');
    Route::get('/article', 'Frontpanel\FrontPostController@browsePost')->name('post');
    Route::post('/loadpost', 'Frontpanel\FrontPostController@load_post')->name('post.load_data');
    Route::get('/review', 'Frontpanel\FrontPostController@browseReview')->name('review');
    Route::get('/tag', 'Frontpanel\FrontPostController@browseTag')->name('tag');
});

Route::prefix('@{username?}')->group(function(){
    Route::get('/{type?}', 'Frontpanel\CreatorController@creator_detail')->name('creator.detail');
    Route::get('/article/{slug}', 'Frontpanel\FrontPostController@publishDetailPost')->name('post.detail');
    Route::get('/review/{slug}', 'Frontpanel\FrontPostController@reviewDetail')->name('review.detail');
});

Route::get('creator', 'Frontpanel\CreatorController@creator')->name('creator');

Route::group(['middleware' => 'auth'], function () {

    // User Controller
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('/dashboard/{type?}', 'ProfileController@dashboard')->name('dashboard');
        Route::post('save', 'ProfileController@save');
        Route::post('password/save', 'ProfileController@change_password');
    });

    // Post Controller
    Route::prefix('post')->group(function (){
        Route::get('/','PostController@index')->name('post.index');
        Route::get('create', 'PostController@create')->name('post.create');
        Route::get('update/{id}', 'PostController@update');
        Route::post('save', 'PostController@save')->name('post.save');
        Route::post('save-photo', 'PostController@savePhoto')->name('post.save-photo');
        Route::get('delete/{id}', 'PostController@delete')->name('post.delete');
        Route::get('tags', 'PostController@ajaxTags');
    });

    // Review Controller
    Route::prefix('review')->group(function (){
        Route::get('/','ReviewController@index')->name('review.index');
        Route::get('create', 'ReviewController@create')->name('review.create');
        Route::get('update/{id}', 'ReviewController@update');
        Route::post('save', 'ReviewController@save')->name('review.save');
        Route::get('delete/{id}', 'ReviewController@delete')->name('review.delete');
    });

    // Back End (ADMIN)
    Route::group(['middleware' => 'AdminRole'], function () {

        Route::prefix('sidebar')->group(function () {
            Route::get('/', 'SidebarController@index');
            Route::get('create', 'SidebarController@create');
            Route::get('update/{id}', 'SidebarController@update');
            Route::post('save', 'SidebarController@save');
            Route::get('delete/{id}', 'SidebarController@delete');
        });

        // Admin Controller
        Route::prefix('admin')->group(function (){

            // Redirect
            Route::redirect('/', 'admin/user');

            // Support Function
            Route::get('support','AdminController@support');
            Route::get('support/delete/{id}', 'AdminController@support_delete');

            // User Function
            Route::get('user','AdminController@user');
            // Route::get('user/disable/{id}','AdminController@disable_user');

            // Post Function
            Route::get('post','Adminpanel\PostAdminController@post');
            Route::get('post/delete/{id}', 'Adminpanel\PostAdminController@post_delete');
            Route::get('review/delete/{id}', 'Adminpanel\PostAdminController@review_delete');
            Route::get('tag_ajax','Adminpanel\PostAdminController@tag_ajax');

            // Category Function
            Route::get('category','CategoryController@category')->name('category');
            Route::get('category/create', 'CategoryController@category_create')->name('category.create');
            Route::get('category/update/{id}', 'CategoryController@category_update')->name('category.update');
            Route::post('category/store', 'CategoryController@category_store')->name('category.store');
            Route::get('category/delete/{id}', 'CategoryController@category_delete');
            Route::get('category/event/{id}', 'CategoryController@makeEvent');
        });
    
    });
    
});
