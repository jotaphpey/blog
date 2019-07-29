<?php

namespace App\Http\Controllers;

use App\traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\AuthorService;
use Illuminate\Http\Response;

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

    public function store(Request $request){
        return $this->successResponse(
            $this->authorService->createAuthors($request->all(), Response::HTTP_CREATED)
        );
    }

    public function show($author){
        return $this->successResponse(
            $this->authorService->obtainAuthor($author)
        );
    }

    public function update(Request $request, $author){
        return $this->successResponse(
            $this->authorService->updateAuthor($request->all() ,$author)
        );
    }

    public function destroy($author){

        return $this->successResponse(
            $this->authorService->deleteAuthor($author)
        );
    }

    //
}
