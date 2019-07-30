<?php

namespace App\Http\Controllers\Api;

use App\Services\ArticleService;
use App\Services\AuthorService;
use App\traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the article service
     * @var ArticleService
     */
    public $articleService;

    /**
     * The service to consume the author service
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, AuthorService $authorService)
    {
        $this->authorService = $authorService;
        $this->articleService = $articleService;
    }

    public function getAll(Request $request){
        return $this->successResponse(
            $this->articleService->obtainArticles($request)
        );
    }

    public function store(Request $request){
        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse(
            $this->articleService->createArticles($request->all(), Response::HTTP_CREATED)
        );
    }

    public function show($article){
        return $this->successResponse(
            $this->articleService->obtainArticle($article)
        );
    }

    public function update(Request $request, $article){
        return $this->successResponse(
            $this->articleService->updateArticle($request->all() ,$article)
        );
    }

    public function destroy($article){

        return $this->successResponse(
            $this->articleService->deleteArticle($article)
        );
    }
}
