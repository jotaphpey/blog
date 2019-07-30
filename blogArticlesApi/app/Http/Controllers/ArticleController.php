<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\traits\ApiResponser;

class ArticleController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @param int $paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $paginate = $request->input("paginate",  10);
        return $this->successResponse(
            Article::orderBy('id', 'desc')->paginate($paginate)
        );
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

        $rules = [
            'title' => 'required|max:191',
            'description' => 'max:191',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $article = Article::create($request->all() + ['slug' => strtolower( str_replace(" ", "-", $request->input("title")) )] );

        return $this->successResponse($article, Response::HTTP_CREATED);
    }

    /**
     * @param $article
     */
    public function show($article){
        $article = Article::findOrFail($article);

        return $this->successResponse($article, Response::HTTP_OK);
    }

    /***
     * @param Request $request
     * @param $article
     */
    public function update(Request $request, $article){

        $rules = [
            'title' => 'required|max:191',
            'description' => 'max:191',
        ];

        $this->validate($request, $rules);

        $article = Article::findOrFail($article);

        $article->fill($request->all() + ['slug' => strtolower( str_replace(" ", "-", $request->input("title")) )] );

        if($article->isClean()){
            return $this->errorResponse("At least one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $article->save();

        return $this->successResponse($article, Response::HTTP_CREATED);
    }

    /**
     * @param $article
     */
    public function destroy($article){
        $article = Article::findOrFail($article);

        $article->delete();

        return $this->successResponse($article);
    }
}
