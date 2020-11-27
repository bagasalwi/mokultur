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
Route::get('/browse', 'Frontpanel\HomeController@browse')->name('browse');

Route::prefix('topic')->group(function () {
    Route::get('/', 'Frontpanel\HomeController@topic')->name('topic');
    Route::get('/{category}', 'Frontpanel\HomeController@topic')->name('topic.detail');
});

Route::prefix('article')->group(function () {
    Route::get('/', 'Frontpanel\FrontPostController@browsePost')->name('post');
    Route::get('/{slug}', 'Frontpanel\FrontPostController@postChecker')->name('post.detail');
});

Route::prefix('reviews')->group(function () {
    Route::get('/', 'Frontpanel\FrontPostController@browseReview')->name('review');
    Route::get('/{slug}', 'Frontpanel\FrontPostController@reviewDetail')->name('review.detail');
});

Route::prefix('creator')->group(function () {
    Route::get('/', 'Frontpanel\CreatorController@creator')->name('creator');
    Route::get('/{username}', 'Frontpanel\CreatorController@creator_detail')->name('creator.detail');
});

Route::group(['middleware' => 'auth'], function () {

    // User Controller
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('/dashboard', 'ProfileController@dashboard')->name('dashboard');
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

            Route::get('/',function(){
                return redirect('admin/user');
            });

            // Support Function
            Route::get('support','AdminController@support');
            Route::get('support/delete/{id}', 'AdminController@support_delete');

            // User Function
            Route::get('user','AdminController@user');

            // Post Function
            Route::get('post','Adminpanel\PostAdminController@post');
            Route::get('post/delete/{id}', 'Adminpanel\PostAdminController@post_delete');

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
