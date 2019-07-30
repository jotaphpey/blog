<?php

namespace App\Http\Controllers\Blog\Author;

use App\Http\Controllers\Api\AuthorController;
use App\Services\AuthorService;
use Illuminate\Http\Request;


class IndexController extends AuthorController {

    public function __construct(AuthorService $authorService)
    {
        parent::__construct($authorService);
    }

    public function index(Request $request){
        $author = $this->getAll($request);

        if($author){
            $author = $author->data->data;
        }

        return view('blog.article.index', ["author" => $author]);
    }

}
