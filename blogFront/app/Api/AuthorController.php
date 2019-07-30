<?php

namespace App\Http\Controllers\Api;

use App\traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\AuthorService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    use ApiResponser;

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
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request){
        return $this->successResponse(
            $this->authorService->obtainAuthors($request)
        );
    }

    public function store($data){
        return $this->successResponse(
            $this->authorService->createAuthors($data, Response::HTTP_CREATED)
        );
    }

    public function show($author){
        return $this->successResponse(
            $this->authorService->obtainAuthor($author)
        );
    }

    public function update($data, $author){
        return $this->successResponse(
            $this->authorService->updateAuthor($data ,$author)
        );
    }

    public function updateImage($request, $author){
        return $this->successResponse(
            $this->authorService->updateAuthorImage($request->all(), $author)
        );
    }

    public function destroy($author){

        return $this->successResponse(
            $this->authorService->deleteAuthor($author)
        );
    }

    //
}
