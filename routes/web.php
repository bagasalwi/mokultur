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
    Route::get('/', 'CreationController@creation');
    Route::get('/{slug}', 'CreationController@creation_detail');
    Route::post('/search', 'CreationController@search_creation');
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
            // sidebar/....
            Route::get('/', 'SidebarController@index');
            Route::get('create', 'SidebarController@create');
            Route::get('update/{id}', 'SidebarController@update');
            Route::post('save', 'SidebarController@save');
            Route::get('delete/{id}', 'SidebarController@delete');
        });
    
        // Post Categories Controller
        Route::prefix('post-category')->group(function (){
            Route::get('/','PostCategoryController@index');
            Route::get('create', 'PostCategoryController@create');
            Route::get('update/{slug}', 'PostCategoryController@update');
            Route::post('save', 'PostCategoryController@save');
            Route::get('delete/{id}', 'PostCategoryController@delete');
        });

        // Tag Controller
        Route::prefix('tag')->group(function (){
            Route::get('/','TagController@index');
            Route::post('create', 'TagController@create');
            Route::get('delete/{id}', 'TagController@delete');
        });
    
    });
    
});
