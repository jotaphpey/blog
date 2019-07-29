<?php

namespace App\Http\Controllers;
use App\Author;
use Illuminate\Http\Response;
use App\traits\ApiResponser;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
            Author::paginate($paginate)
        );
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

        $rules = [
            'username' => 'required|max:191',
            'gender' => 'required|max:191|in:male,female',
            'country' => 'required|max:191',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * @param $author
     */
    public function show($author){
        $author = Author::findOrFail($author);

        return $this->successResponse($author, Response::HTTP_OK);
    }

    /***
     * @param Request $request
     * @param $author
     */
    public function update(Request $request, $author){
        $rules = [
            'username' => 'max:191',
            'gender' => 'max:191|in:male,female',
            'country' => 'max:191',
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);

        $author->fill($request->all());

        if($author->isClean()){
            return $this->errorResponse("At least one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * @param $author
     */
    public function destroy($author){
        $author = Author::findOrFail($author);

        $author->delete();

        return $this->successResponse($author);
    }
}
