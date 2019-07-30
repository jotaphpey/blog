<?php

namespace App\Http\Controllers;
use App\Author;
use Illuminate\Http\Response;
use App\traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

    public function patch(Request $request, $author){

        $author = Author::findOrFail($author);
        $input = Input::all();

        dd(( file_get_contents("php://input")));

        $author->image = ($request->all());

        $author->save();

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /***
     * @param Request $request
     * @param $author
     */
    public function update(Request $request, $author){
        $rules = [
            'username' => 'max:191',
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

    function parse_raw_http_request(array &$a_data)
    {
        // read incoming data
        $input = file_get_contents('php://input');

        // grab multipart boundary from content type header
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];

        // split content by boundary and get rid of last -- element
        $a_blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);

        // loop data blocks
        foreach ($a_blocks as $id => $block)
        {
            if (empty($block))
                continue;

            // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

            // parse uploaded files
            if (strpos($block, 'application/octet-stream') !== FALSE)
            {
                // match "name", then everything after "stream" (optional) except for prepending newlines
                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
            }
            // parse all other fields
            else
            {
                // match "name" and optional value in between newline sequences
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            $a_data[$matches[1]] = $matches[2];
        }
    }
}
