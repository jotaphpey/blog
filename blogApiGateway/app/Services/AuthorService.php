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

class AuthorService{

    use ConsumesExternalService;
    /**
     * @var String
     */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

    /**
     * Get full list of authors
     */
    public function obtainAuthors(Request $request){
        $paginate = $request->input("paginate",  10);

        return $this->performeRequest(
            "get", "/authors?paginate=".$paginate
        );
    }

    /**
     * Create author instance
     * @param array $data
     * @return string
     */
    public function createAuthors($data){
        return $this->performeRequest(
            "post", "/authors", $data
        );
    }

    public function obtainAuthor($author){
        return $this->performeRequest(
            "get", "/authors/{$author}"
        );
    }

    /**
     * @param array $data
     * @param int $author
     * @return string
     */
    public function updateAuthor($data, $author){
        return $this->performeRequest(
            "put", "/authors/{$author}", $data
        );
    }

    public function deleteAuthor($author){
        return $this->performeRequest(
            "delete", "/authors/{$author}"
        );
    }
}