<?php
/**
 * Created by PhpStorm.
 * User: jp
 * Date: 28/07/2019
 * Time: 11:49 PM
 */
namespace App\Services;

use App\traits\ConsumesExternalService;
use Illuminate\Http\Request;

class ArticleService{

    use ConsumesExternalService;
    /**
     * @var String
     */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.articles.base_uri');
    }

    /**
     * Get full list of articles
     */
    public function obtainArticles(Request $request){
        $paginate = $request->input("paginate",  10);

        return $this->performeRequest(
            "get", "/articles?paginate=".$paginate
        );
    }

    /**
     * Create article instance
     * @param array $data
     * @return string
     */
    public function createArticles($data){
        return $this->performeRequest(
            "post", "/articles", $data
        );
    }

    public function obtainArticle($article){
        return $this->performeRequest(
            "get", "/articles/{$article}"
        );
    }

    /**
     * @param array $data
     * @param int $article
     * @return string
     */
    public function updateArticle($data, $article){
        return $this->performeRequest(
            "put", "/articles/{$article}", $data
        );
    }

    public function deleteArticle($article){
        return $this->performeRequest(
            "delete", "/articles/{$article}"
        );
    }
}