<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);
//home.post is used so that when we need to submit a form we can use
//route('home.post') instead of writing the whole path like action='/post/$post->id.
//Route::get('/post/{id}', 'AdminPostsController@post');

Route::group(['middleware'=>'admin'], function(){

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');

    Route::resource('admin/comments', 'PostCommentController');
    Route::resource('admin/comment/replies', 'CommentRepliesController');

});

//This will give access just to the user logged in
//Route::group(['middleware'=>'auth'], function(){
//    Route::resource('admin/comments', 'PostCommentController');
//    Route::post('admin/comment/replies', 'CommentRepliesController');
//});

Route::get('/admin', function(){
   return view('admin.index');
});