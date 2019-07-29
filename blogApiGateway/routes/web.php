<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/* Articles Routes */
$router->get('/articles', 'ArticleController@index');
$router->post('/articles', 'ArticleController@store');
$router->get('/articles/{article}', 'ArticleController@show');
$router->put('/articles/{article}', 'ArticleController@update');
$router->patch('/articles/{article}', 'ArticleController@update');
$router->delete('/articles/{article}', 'ArticleController@destroy');

/* Author Routes */
$router->get('/authors', 'AuthorController@index');
$router->post('/authors', 'AuthorController@store');
$router->get('/authors/{author}', 'AuthorController@show');
$router->put('/authors/{author}', 'AuthorController@update');
$router->patch('/authors/{author}', 'AuthorController@update');
$router->delete('/authors/{author}', 'AuthorController@destroy');