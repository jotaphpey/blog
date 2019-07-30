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

Route::get('/', 'Blog\IndexController@index')->name('home');

Auth::routes();

Route::get('/home', 'Blog\IndexController@index')->name('blog');

Route::get('/add', 'Blog\IndexController@add')->name('blog-add')->middleware('auth');

Route::get('/admin', 'Admin\IndexController@index')->name('admin')->middleware('auth');
