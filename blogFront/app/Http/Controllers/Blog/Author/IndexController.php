<?php

namespace App\Http\Controllers\Blog\Author;

use App\Http\Controllers\Api\AuthorController;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IndexController extends AuthorController {


    public function __construct(AuthorService $authorService)
    {
        parent::__construct($authorService);
    }

    public function index(Request $request){
        $author = $this->show(Auth::user()->author_id);

        if($author){
            $author = $author->data;
        }

        if(!$author->image){
            $img_path = public_path("images").DIRECTORY_SEPARATOR."default.png";
            $img_data = file_get_contents($img_path);
            $type = pathinfo($img_path, PATHINFO_EXTENSION);
            $base64 = base64_encode($img_data);
            $author->image = $base64;
        }

        return view('blog.author.index', ["author" => $author]);

    }

    public function updateAuthor(Request $request){
        $author = $this->show(Auth::user()->author_id);
        $contents = $this->getImageContent($request);

        if($request->username != $author->data->username  || $contents){
            $autorUpdated = $this->update(["username" => $request->username, "image"=> $contents], Auth::user()->author_id);

            if($autorUpdated){
                return Redirect::to('/profile')->withErrors(['Error']);
            }
        }

        return Redirect::to('/profile')->with("success", ['Error']);
    }

    public function getImageContent($request){
        if(!isset($request->image)){
            return false;
        }
        return base64_encode(file_get_contents($request->image->getPath().DIRECTORY_SEPARATOR.$request->image->getFileName()));

        /*return [
            'name'     => 'image',
            'contents' => $contents,
            'filename' => $request->image->getFileName()
        ];*/
        /*$file = $request->file('image');

        // Get the contents of the file
        $contents = $file->openFile()->fread($file->getSize());*/


    }

}
