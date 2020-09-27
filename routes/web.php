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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/topic', 'HomeController@category');
Route::get('/topic/{category}', 'HomeController@category');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact-submit', 'HomeController@contact_submit');


Route::prefix('creator')->group(function () {
    Route::get('/', 'CreatorController@creator');
    Route::get('/{username}', 'CreatorController@creator_detail');
    Route::post('/search', 'CreatorController@search_creator');
});

Route::prefix('creation')->group(function () {
    Route::get('/', 'CreationController@creation');
    // Route::get('/search', 'CreationController@ajaxSearch');
    Route::get('/{slug}', 'CreationController@creation_detail');
    // Route::post('/search', 'CreationController@search_creation');
    Route::get('/category/{name}', 'CreationController@category_creation');
});

Route::get('/browse', 'CreationController@browse');



Route::group(['middleware' => 'auth'], function () {

    // User Controller

    Route::get('/home', 'CreatorController@index');

    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index');
        Route::post('save', 'ProfileController@save');
        Route::post('password/save', 'ProfileController@change_password');
    });

    // Post Controller
    Route::prefix('post')->group(function (){
        Route::get('/','PostController@index')->name('post.index');
        Route::get('create', 'PostController@create')->name('post.create');
        Route::get('update/{id}', 'PostController@update');
        Route::post('save', 'PostController@save')->name('post.save');
        Route::get('delete/{id}', 'PostController@delete')->name('post.delete');
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
            // Support Function
            Route::get('support','AdminController@support');
            Route::get('support/delete/{id}', 'AdminController@support_delete');

            // User Function
            Route::get('user','AdminController@user');

            // Post Function
            Route::get('post','AdminController@post');
            Route::get('post/delete/{id}', 'AdminController@post_delete');

            // Category Function
            Route::get('category','CategoryController@category')->name('category');
            Route::get('category/create', 'CategoryController@category_create')->name('category.create');
            Route::get('category/update/{id}', 'CategoryController@category_update')->name('category.update');
            Route::post('category/store', 'CategoryController@category_store')->name('category.store');
            Route::get('category/delete/{id}', 'CategoryController@category_delete');

            // Tag Function
            Route::get('tag','AdminController@tag');
            Route::post('tag/create', 'AdminController@tag_create');
            Route::get('tag/delete/{id}', 'AdminController@tag_delete');
        });
    
    });
    
});
