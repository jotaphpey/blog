<?php

namespace App\Http\Controllers\Blog;

use App\Services\ArticleService;
use App\Services\AuthorService;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Auth;

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

    public function create(Request $request){

        $result = [
            "success" => false,
            "message" => "Error, article not saved",
        ];

        $request->merge([
            "slug"=>str_replace(" ", "-", strtolower($request->title)),
            "author_id"=> Auth::user()->author_id,
        ]);

        $store = $this->store($request);

        if($store){
            $result["success"] = true;
        }

        return $result;
    }

    public function delete(Request $request){
        $result = [
            "success" => false,
            "message" => "Error removing article",
        ];

        $article = $this->show($request->article);

        if($article->data->author_id != Auth::user()->author_id){
            return [
                "success" => false,
                "message" => "Error, unauthorized",
            ];
        }

        $ArticleStored = $this->destroy($request->article);

        if($ArticleStored){
            $result["success"] = true;
            $result["article"] = $ArticleStored;
        }

        return $result;
    }
}
