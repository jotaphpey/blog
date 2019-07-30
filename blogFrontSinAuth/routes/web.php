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

Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::get('/register', 'Auth\AuthController@register')->name('register');


/* Blog */
Route::get('/', 'Blog\IndexController@index')->name('blog');

/* Admin */
Route::get('/admin', 'Admin\IndexController@index')->name('admin');