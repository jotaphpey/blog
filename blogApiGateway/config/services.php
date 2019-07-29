<?php
/**
 * Created by PhpStorm.
 * User: jp
 * Date: 28/07/2019
 * Time: 11:37 PM
 */
return [
    'authors' => [
        'base_uri' => env('AUTHORS_SERVICE_BASE_URI'),
        'secret' => env('AUTHORS_SERVICE_SECRET'),
    ],
    'articles' => [
        'base_uri' => env('ARTICLES_SERVICE_BASE_URI'),
        'secret' => env('ARTICLES_SERVICE_SECRET'),
    ],
];
