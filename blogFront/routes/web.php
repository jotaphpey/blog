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

Route::get('/', 'Blog\Article\IndexController@index')->name('home');

Auth::routes();

Route::get('/home', 'Blog\Article\IndexController@index')->name('blog');
Route::get('/profile', 'Blog\Author\IndexController@index')->name('profile');


Route::get('/add', 'Blog\Article\IndexController@add')->name('blog-add')->middleware('auth');
Route::post('/create', 'Blog\Article\IndexController@create')->name('blog-create')->middleware('auth');
Route::post('/delete-article', 'Blog\Article\IndexController@delete')->name('blog-delete')->middleware('auth');



Route::group(['middleware' => 'App\Http\Middleware\CheckRole'], function() {
    Route::get('/admin', 'Admin\IndexController@index')->name('admin')->middleware('auth');
});