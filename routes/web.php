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
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact-submit', 'HomeController@contact_submit');


Route::prefix('creator')->group(function () {
    Route::get('/', 'CreatorController@creator');
    Route::get('/{username}', 'CreatorController@creator_detail');
    Route::post('/search', 'CreatorController@search_creator');
});

Route::prefix('creation')->group(function () {
    Route::get('/', 'CreationController@all_creation');
    Route::get('/{slug}', 'CreationController@creation_detail');
    Route::post('/search', 'CreationController@search_creation');
    Route::get('/category/{name}', 'CreationController@category_creation');
});



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
        Route::get('/','PostController@index');
        Route::get('create', 'PostController@create');
        Route::get('update/{id}', 'PostController@update');
        Route::post('save', 'PostController@save');
        Route::get('delete/{id}', 'PostController@delete');
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

        // Tag Controller
        Route::prefix('admin')->group(function (){
            Route::get('support','AdminController@support');
            Route::get('support/delete/{id}', 'AdminController@support_delete');

            Route::get('post','AdminController@post');
            Route::get('post/delete/{id}', 'AdminController@post_delete');

            // Category Function
            Route::get('category','AdminController@category');
            Route::post('category/create', 'AdminController@category_create');
            Route::get('category/delete/{id}', 'AdminController@category_delete');

            // Tag Function
            Route::get('tag','AdminController@tag');
            Route::post('tag/create', 'AdminController@tag_create');
            Route::get('tag/delete/{id}', 'AdminController@tag_delete');
        });
    
    });
    
});
