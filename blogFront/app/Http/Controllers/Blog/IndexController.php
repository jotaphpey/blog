<?php

namespace App\Http\Controllers\Blog;

use App\Services\ArticleService;
use App\Services\AuthorService;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\ArticleController;

class IndexController extends ArticleController
{
    public function __construct(ArticleService $articleService, AuthorService $authorService)
    {
        parent::__construct($articleService, $authorService);
    }

    public function index(Request $request){
        $posts = $this->getAll($request);

        if($posts){
            $posts = $posts->data->data;
        }

        return view('blog.index', ["posts" => $posts]);
    }

    public function add(){

        return view('blog.add');
    }
}
