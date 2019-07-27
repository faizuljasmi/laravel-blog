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
//Best practice is to give distinct name ex: name('module:function')
Route::get('/home', 'HomeController@index')->name('home');

//Middleware is to categorize access of the pages
Route::group(['prefix' => 'admin/posts', 'middleware' => 'auth'], function(){
  //Posts Route
  Route::get('/', 'PostsController@index')->name('posts_index')->middleware('can:viewAny,App\Post');
  //Create Routes (have to write to become more expert)
  Route::get('/create', 'PostsController@create')->name('posts_create')->middleware('can:create,App\Post');
  //Post because we use POST method
  Route::post('/store', 'PostsController@store')->name('posts_store')->middleware('can:create,App\Post');
  //Edit POST
  Route::get('/edit/{post}','PostsController@edit')->name('posts_edit')->middleware('can:update,post');
  //Update Post
  Route::post('/update/{post}', 'PostsController@update')->name('posts_update')->middleware('can:update,post');;
  //Delete POST
  Route::get('/delete/{post}', 'PostsController@delete')->name('posts_delete')->middleware('can:delete,post');;
  //comment
  Route::post('/comment/{post}', 'CommentsController@store')->name('posts_comment');
  //Comment Reply
  Route::post('/comment/{post}/reply', 'CommentsController@reply')->name('posts_comment_reply');
  //Comment Delete
  Route::get('/comment/{comment}/delete','CommentsController@delete')->name('posts_comment_delete')->middleware('can:delete,comment');
});

//Route for blog display
Route::get('/', 'BlogController@index')->name('blog_index');
Route::get('/blog/{post}', 'BlogController@post')->name('blog_post');
Route::get('/search', 'BlogController@search')->name('blog_search');
Route::get('/categories/{category}', 'BlogController@categories')->name('blog_categories');
