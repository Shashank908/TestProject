<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');

Route::group([['middleware' => ['jwt.auth']]], function(){
	Route::group([['middleware'=> ['role:admin|manager']]], function()
	{
		Route::get('/posts', 'PostController@index')->name('posts.index');
		Route::delete('/post/deleteall', 'PostController@destroyall');
	});
	Route::group([['middleware' => ['role:admin|manager|user']]], function()
	{
		Route::post('/posts', 'PostController@store')->name('posts.store');
		Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
		Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
		Route::delete('/posts/{post}', 'PostController@destory1');
		Route::post('/logout', 'AuthController@logout');
	});
	Route::group([['middleware' => ['role:admin']]], function()
	{
		// Create roles by Administrator
		Route::get('/roles', 'AdminController@getRole')->name('roles.getRole');
		Route::post('/update/{user_id}/{roles}', 'AdminController@updateRole');
		Route::get('/users', 'AdminController@user');
		Route::post('/create/user', 'AdminController@createuser');
		Route::delete('/delete/user/{id}', 'AdminController@delete1');
	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
